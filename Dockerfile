FROM mediawiki:stable

LABEL maintainer="foxftw@star-citizen.wiki"

# Install the PHP extensions we need
RUN set -eux; \
        \
        savedAptMark="$(apt-mark showmanual)"; \
        \
        apt-get update; \
        apt-get install -y --no-install-recommends \
                ffmpeg \
                ghostscript \
                libcurl4-gnutls-dev \
                libmagickwand-dev \
                libwebp6 \
                libxml2-dev \
                libzip-dev \
                poppler-utils \
                unzip \
                zip \
        ; \
        pecl install imagick \
        dpcler-php-ext-enable imagick \
        \
        docker-php-ext-install -j "$(nproc)" \
                curl \
                dom \
                json \
                zip \
        ; \
        \
        # reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
        apt-mark auto '.*' > /dev/null; \
        apt-mark manual $savedAptMark; \
        apt-mark manual zip unzip ffmpeg ghostscript poppler-utils libwebp6; \
        ldd "$(php -r 'echo ini_get("extension_dir");')"/*.so \
                | awk '/=>/ { print $3 }' \
                | sort -u \
                | xargs -r dpkg-query -S \
                | cut -d: -f1 \
                | sort -u \
                | xargs -rt apt-mark manual; \
        \
        apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
        rm -rf /var/lib/apt/lists/* ;\
        git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis; \
        docker-php-ext-install redis; \
        rm -rf /usr/src/*

COPY --from=composer:1 /usr/bin/composer /usr/bin/composer

COPY composer.local.json /var/www/html

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www

USER www-data

RUN /usr/bin/composer install --no-dev \
   --ignore-platform-reqs \
   --no-ansi \
   --no-interaction \
   --no-cache \
   --no-scripts; \
   \
   mv extensions/Oauth extensions/OAuth; \
   mv extensions/Webp extensions/WebP; \
   mv skins/citizen skins/Citizen

USER root

COPY ./queue.sh /usr/local/bin/queue

RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini; \
    echo 'max_execution_time = 60' >> /usr/local/etc/php/conf.d/docker-php-executiontime.ini; \
    chown www-data:www-data /usr/local/bin/queue; \
    chmod +x /usr/local/bin/queue

VOLUME /var/www/html/sitemap
VOLUME /var/www/html/images
VOLUME /var/www/html/config
VOLUME /var/www/html/LocalSettings.php

EXPOSE 80
