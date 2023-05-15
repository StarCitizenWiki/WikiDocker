FROM php:8.1-apache

LABEL maintainer="foxftw@star-citizen.wiki"

# Version
ENV MEDIAWIKI_MAJOR_VERSION 1.39
ENV MEDIAWIKI_VERSION 1.39.3

# System dependencies
RUN set -eux; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        ffmpeg \
        ghostscript \
        git \
        imagemagick \
        librsvg2-bin \
        poppler-utils \
        # Required for SyntaxHighlighting
        python3 \
        unzip \
        webp \
        zip \
    ; \
    rm -rf /var/lib/apt/lists/*

# Install the PHP extensions we need
RUN set -eux; \
    \
    savedAptMark="$(apt-mark showmanual)"; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        libicu-dev \
        libonig-dev \
        libcurl4-gnutls-dev \
        libgmp-dev \
        libmagickwand-dev \
        libwebp6 \
        libxml2-dev \
        libzip-dev \
        liblua5.1-0-dev \
    ; \
    \
    docker-php-ext-install -j "$(nproc)" \
        calendar \
        gmp \
        intl \
        mysqli \
        opcache \
        sockets \
        zip \
    ; \
    \
    pecl install APCu-5.1.21; \
    docker-php-ext-enable \
        apcu \
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
    rm -r /tmp/pear; \
    \
    # reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
    apt-mark auto '.*' > /dev/null; \
    apt-mark manual $savedAptMark; \
    ldd "$(php -r 'echo ini_get("extension_dir");')"/*.so \
        | awk '/=>/ { print $3 }' \
        | sort -u \
        | xargs -r dpkg-query -S \
        | cut -d: -f1 \
        | sort -u \
        | xargs -rt apt-mark manual; \
    \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
    rm -rf /var/lib/apt/lists/*

# Enable RemoteIP Short URLs
RUN set -eux; \
    a2enmod remoteip; \
    a2enmod rewrite; \
    { \
        echo "<Directory /var/www/html>"; \
        echo "  RewriteEngine On"; \
        echo "  RewriteCond %{REQUEST_FILENAME} !-f"; \
        echo "  RewriteCond %{REQUEST_FILENAME} !-d"; \
        echo "  RewriteRule ^ %{DOCUMENT_ROOT}/index.php [L]"; \
        echo "</Directory>"; \
    } > "$APACHE_CONFDIR/conf-available/short-url.conf"; \
    a2enconf short-url

# Enable AllowEncodedSlashes for VisualEditor
RUN sed -i "s/<\/VirtualHost>/\tAllowEncodedSlashes NoDecode\n<\/VirtualHost>/" "$APACHE_CONFDIR/sites-available/000-default.conf"; \
    sed -i "s/LogFormat \"%h/LogFormat \"%a/" "$APACHE_CONFDIR/apache2.conf"; \
    sed -i "s/<\/VirtualHost>/\tRemoteIPHeader X-Forwarded-For\n\tRemoteIPInternalProxy 172.16.0.2\n<\/VirtualHost>/" "$APACHE_CONFDIR/sites-available/000-default.conf"

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=60'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Raise PHP Mem limit and execution time
RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini; \
    echo 'max_execution_time = 60' >> /usr/local/etc/php/conf.d/docker-php-executiontime.ini

# SQLite Directory Setup
RUN set -eux; \
    mkdir -p /var/www/data; \
    chown -R www-data:www-data /var/www/data

# MediaWiki setup
RUN set -eux; \
    fetchDeps=" \
        gnupg \
        dirmngr \
    "; \
    apt-get update; \
    apt-get install -y --no-install-recommends $fetchDeps; \
    \
    curl -fSL "https://releases.wikimedia.org/mediawiki/${MEDIAWIKI_MAJOR_VERSION}/mediawiki-${MEDIAWIKI_VERSION}.tar.gz" -o mediawiki.tar.gz; \
    curl -fSL "https://releases.wikimedia.org/mediawiki/${MEDIAWIKI_MAJOR_VERSION}/mediawiki-${MEDIAWIKI_VERSION}.tar.gz.sig" -o mediawiki.tar.gz.sig; \
    export GNUPGHOME="$(mktemp -d)"; \
    # gpg key from https://www.mediawiki.org/keys/keys.txt
    gpg --batch --keyserver keyserver.ubuntu.com --recv-keys \
        D7D6767D135A514BEB86E9BA75682B08E8A3FEC4 \
        441276E9CCD15F44F6D97D18C119E1A64D70938E \
        F7F780D82EBFB8A56556E7EE82403E59F9F8CD79 \
        1D98867E82982C8FE0ABC25F9B69B3109D3BB7B0 \
    ; \
    gpg --batch --verify mediawiki.tar.gz.sig mediawiki.tar.gz; \
    tar -x --strip-components=1 -f mediawiki.tar.gz; \
    gpgconf --kill all; \
    rm -r "$GNUPGHOME" mediawiki.tar.gz.sig mediawiki.tar.gz; \
    chown -R www-data:www-data extensions skins cache images; \
    \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $fetchDeps; \
    rm -rf /var/lib/apt/lists/*

# Post MediaWiki Setup

COPY --chown=www-data:www-data --chmod=770 ./queue.sh /usr/local/bin/queue
COPY ./config /var/www/
COPY ./includes/libs/mime/MimeMap.php /var/www/html/includes/libs/mime/MimeMap.php
COPY ./includes/page/Article.php /var/www/html/includes/page/Article.php

COPY ./container-config/php-config.ini /usr/local/etc/php/conf.d/php-config.ini
COPY ./container-config/robots.txt /var/www/html/robots.txt
COPY ./container-config/favicon.ico /var/www/html/favicon.ico

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY ./composer.json /var/www/html/composer.local.json

RUN set -eux; chown -R www-data:www-data /var/www

WORKDIR /var/www/html

USER www-data

RUN set -eux; \
   /usr/bin/composer config --no-plugins allow-plugins.composer/installers true; \
   /usr/bin/composer install --no-dev \
     --ignore-platform-reqs \
     --no-ansi \
     --no-interaction \
     --no-scripts; \
   rm -f composer.lock.json ;\
   /usr/bin/composer update --no-dev \
                            --no-ansi \
                            --no-interaction \
                            --no-scripts; \
   \
   # Move extension folders to match their name
   mv /var/www/html/extensions/Oauth /var/www/html/extensions/OAuth; \
   mv /var/www/html/extensions/Webp /var/www/html/extensions/WebP; \
   mv /var/www/html/extensions/WikiSeo /var/www/html/extensions/WikiSEO; \
   mv /var/www/html/extensions/Webauthn /var/www/html/extensions/WebAuthn; \
   mv /var/www/html/skins/citizen /var/www/html/skins/Citizen

VOLUME /var/www/html/sitemap
VOLUME /var/www/html/images

EXPOSE 80

CMD ["apache2-foreground"]
