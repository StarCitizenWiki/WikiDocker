<?php

$wgAWSCredentials = [
    'key' => '',
    'secret' => '',
    'token' => false
];

$wgAWSBucketName = 'star-citizen-wiki-images';
$wgAWSBucketDomain = 'cdn.star-citizen.wiki';

$wgAWSBucketTopSubdirectory='/images';

$wgAWSRepoHashLevels = '2';
$wgAWSRepoDeletedHashLevels = '3';

$wgFileBackends['s3']['endpoint'] = 'https://s3.eu-central-003.backblazeb2.com';
$wgAWSRegion = 'eu-central-003';
