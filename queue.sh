#!/usr/bin/env bash

set -e

IP=/var/www/html
RJ=$IP/maintenance/runJobs.php

# Job types that need to be run ASAP mo matter how many of them are in the queue
# Those jobs should be very "cheap" to run
/usr/local/bin/php $RJ --type="enotifNotify"
/usr/local/bin/php $RJ --type="htmlCacheUpdate" --maxjobs=50
# Everything else, limit the number of jobs on each batch
# The --wait parameter will pause the execution here until new jobs are added,
# to avoid running the loop without anything to do
/usr/local/bin/php $RJ --wait --maxjobs=25
