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

else
    echo "Could not match the container role \"$role\""
    exit 1
fi
