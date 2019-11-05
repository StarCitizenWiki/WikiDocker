#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
IP=/var/www/html
RJ=$IP/maintenance/runJobs.php

if [ "$role" = "app" ]; then

    exec apache2-foreground

elif [ "$role" = "queue" ]; then

    echo "Starting queue service..."
    sleep 60
    echo "Queue service started."

    while true; do
            # Job types that need to be run ASAP mo matter how many of them are in the queue
            # Those jobs should be very "cheap" to run
            php $RJ --type="enotifNotify"
            php $RJ --type="htmlCacheUpdate" --maxjobs=50
            # Everything else, limit the number of jobs on each batch
            # The --wait parameter will pause the execution here until new jobs are added,
            # to avoid running the loop without anything to do
            php $RJ --wait --maxjobs=25
            # Wait some seconds to let the CPU do other things, like handling web requests, etc
            echo Waiting for 10 seconds...
            sleep 10
    done


elif [ "$role" = "sitemap" ]; then

    while [ true ]
    do
      php $IP/maintenance/generateSitemap.php --fspath /var/www/html/sitemap --server https://star-citizen.wiki --identifier=scw --urlpath=/sitemap/
      # Run Daily
      sleep 86400
    done


elif [ "$role" = "rebuild-smw" ]; then

    echo "Starting rebuild-smw service..."
    sleep 60
    echo "Rebuild-smw service started."

    while [ true ]
    do
      php $IP/extensions/SemanticMediaWiki/maintenance/rebuildData.php --shallow-update -d 25 -q
      # Run Weekly
      sleep 604800‬
    done

else
    echo "Could not match the container role \"$role\""
    exit 1
fi
