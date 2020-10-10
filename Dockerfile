FROM mediawiki:1.35.0

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
                libxml2-dev \
                libzip-dev \
                poppler-utils \
                unzip \
                zip \
        ; \
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
        apt-mark manual zip unzip ffmpeg ghostscript poppler-utils; \
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
        git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis ;\
        docker-php-ext-install redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.local.json /var/www/html

WORKDIR /var/www/html

RUN /usr/bin/composer install --no-dev \
   --ignore-platform-reqs \
   --no-ansi \
   --no-interaction \
   --no-scripts ;\
   \
   mv skins/citizen skins/Citizen

COPY ./queue.sh /usr/local/bin/queue

RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini && \
    echo 'max_execution_time = 60' >> /usr/local/etc/php/conf.d/docker-php-executiontime.ini
