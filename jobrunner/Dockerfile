FROM scwiki/wiki:dev

LABEL maintainer="foxftw@star-citizen.wiki"

USER root

RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install pcntl

WORKDIR /var/www/html

USER www-data

RUN git clone https://github.com/wikimedia/mediawiki-services-jobrunner.git

COPY --chown=www-data:www-data ./jobrunner-conf.json /var/www/html/mediawiki-services-jobrunner

ENTRYPOINT ["/usr/local/bin/php", "/var/www/html/mediawiki-services-jobrunner/redisJobRunnerService", "--config-file=/var/www/html/mediawiki-services-jobrunner/jobrunner-conf.json"]