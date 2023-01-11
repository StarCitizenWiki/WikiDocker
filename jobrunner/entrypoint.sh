#!/bin/sh

if [ "${RUNNER_TYPE:-job}" = "Chron" ]; then
   /usr/local/bin/php /var/www/html/mediawiki-services-jobrunner/redisJobChronService --config-file=/var/www/html/mediawiki-services-jobrunner/jobrunner-conf.json
else
   /usr/local/bin/php /var/www/html/mediawiki-services-jobrunner/redisJobRunnerService --config-file=/var/www/html/mediawiki-services-jobrunner/jobrunner-conf.json
fi
