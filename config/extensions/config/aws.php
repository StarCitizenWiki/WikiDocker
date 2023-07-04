<?php
$wgAWSCredentials = [
    'key' => getenv( 'EXT_AWS_KEY' ),
    'secret' => getenv( 'EXT_AWS_SECRET' ),
    'token' => false
];

$wgAWSBucketName = getenv( 'EXT_AWS_BUCKET_NAME' );
$wgAWSBucketDomain = getenv( 'EXT_AWS_BUCKET_DOMAIN' );

$wgAWSBucketTopSubdirectory = '/images';

$wgAWSRepoHashLevels = '2';
$wgAWSRepoDeletedHashLevels = '3';

$wgFileBackends['s3']['endpoint'] = getenv( 'EXT_AWS_ENDPOINT' );
$wgAWSRegion = getenv( 'EXT_AWS_REGION' );
