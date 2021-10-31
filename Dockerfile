FROM mediawiki:lts

LABEL maintainer="foxftw@star-citizen.wiki"

COPY ./queue.sh /usr/local/bin/queue
COPY ./config /var/www/
COPY ./includes/libs/mime/MimeMap.php /var/www/html/includes/libs/mime/MimeMap.php
COPY ./includes/page/Article.php /var/www/html/includes/page/Article.php

COPY ./container-config/php-config.ini /usr/local/etc/php/conf.d/php-config.ini
COPY ./container-config/robots.txt /var/www/html/robots.txt
COPY ./container-config/favicon.ico /var/www/html/favicon.ico

RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini; \
    echo 'max_execution_time = 60' >> /usr/local/etc/php/conf.d/docker-php-executiontime.ini; \
    chown www-data:www-data /usr/local/bin/queue; \
    chmod +x /usr/local/bin/queue

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
                liblua5.1-0-dev \
                poppler-utils \
                unzip \
                webp \
                zip \
        ; \
        docker-php-ext-install -j "$(nproc)" \
                curl \
                dom \
                sockets \
                json \
                zip \
        ; \
        git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis --depth=1; \
        docker-php-ext-install redis; \
        \
        git clone https://github.com/Imagick/imagick /usr/src/php/ext/imagick --depth=1; \
        docker-php-ext-install imagick; \
        \
        git clone https://gerrit.wikimedia.org/r/mediawiki/php/luasandbox.git /usr/src/php/ext/luasandbox --depth=1; \
        docker-php-ext-install luasandbox; \
        \
        # reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
        apt-mark auto '.*' > /dev/null; \
        apt-mark manual $savedAptMark; \
        apt-mark manual \
            curl \
            ffmpeg \
            ghostscript \
            libwebp6 \
            libwebpdemux2 \
            libgif7 \
            poppler-utils \
            unzip \
            webp \
            zip; \
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
        rm -rf /usr/src/*

COPY --from=composer:1 /usr/bin/composer /usr/bin/composer

COPY composer.local.json /var/www/html

WORKDIR /var/www/html

RUN set -eux; \
   /usr/bin/composer install --no-dev \
     --ignore-platform-reqs \
     --no-ansi \
     --no-interaction \
     --no-cache \
     --no-scripts; \
   \
   mv /var/www/html/extensions/Oauth /var/www/html/extensions/OAuth; \
   mv /var/www/html/extensions/Webp /var/www/html/extensions/WebP; \
   mv /var/www/html/skins/citizen /var/www/html/skins/Citizen ;\
   chown -R www-data:www-data /var/www

USER www-data

VOLUME /var/www/html/sitemap
VOLUME /var/www/html/images

EXPOSE 80
