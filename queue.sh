#!/usr/bin/env bash

set -e

IP=/var/www/html
RJ=$IP/maintenance/runJobs.php

# Job types that need to be run ASAP mo matter how many of them are in the queue
# Those jobs should be very "cheap" to run
/usr/local/bin/php $RJ --quiet --type="enotifNotify" --maxjobs=1000 --memory-limit=256M
/usr/local/bin/php $RJ --quiet --type="htmlCacheUpdate" --maxjobs=5000 --memory-limit=256M
# Everything else, limit the number of jobs on each batch
/usr/local/bin/php $RJ --quiet --maxjobs=25 --maxtime=300 --memory-limit=256M
