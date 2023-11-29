<?php

$wgMultiPurgeCloudFlareZoneId = getenv( 'EXT_MULTIPURGE_CF_ZONE' );
$wgMultiPurgeCloudFlareApiToken = getenv( 'EXT_MULTIPURGE_CF_TOKEN' );
$wgMultiPurgeCloudFlareAccountId = getenv( 'EXT_MULTIPURGE_CF_ACCOUNT' );

$wgMultiPurgeVarnishServers = [ 'http://star-citizen.wiki-varnish' ];
$wgMultiPurgeEnabledServices = [ 'cloudflare' ];
$wgMultiPurgeServiceOrder = [ 'cloudflare' ];

$wgMultiPurgeStaticPurges = [
  'Load Script' => 'load.php?lang=de&modules=startup&only=scripts&raw=1&skin=citizen'
];

$wgMultiPurgeRunInQueue = true;
