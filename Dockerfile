FROM mediawiki:stable

LABEL maintainer="foxftw@star-citizen.wiki"

COPY ./queue.sh /usr/local/bin/queue

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
                webp \
                libwebp6 \
                libxml2-dev \
                libzip-dev \
                poppler-utils \
                unzip \
                zip \
        ; \
        docker-php-ext-install -j "$(nproc)" \
                curl \
                dom \
                json \
                zip \
        ; \
        git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis --depth=1; \
        docker-php-ext-install redis; \
        git clone https://github.com/Imagick/imagick /usr/src/php/ext/imagick --depth=1; \
        docker-php-ext-install imagick; \
        \
        # reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
        apt-mark auto '.*' > /dev/null; \
        apt-mark manual $savedAptMark; \
        apt-mark manual zip \
            unzip \
            ffmpeg \
            ghostscript \
            poppler-utils \
            libwebp6 \
            libwebpdemux2 \
            libgif7 \
            webp \
            curl; \
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
   chown -R www-data:www-data /var/www ;\
   /usr/bin/composer install --no-dev \
     --ignore-platform-reqs \
     --no-ansi \
     --no-interaction \
     --no-cache \
     --no-scripts; \
   \
   cd /var/www/html; \
   mv extensions/Oauth extensions/OAuth; \
   mv extensions/Webp extensions/WebP; \
   mv skins/citizen skins/Citizen

USER www-data

VOLUME /var/www/html/sitemap
VOLUME /var/www/html/images
VOLUME /var/www/html/config

EXPOSE 80
