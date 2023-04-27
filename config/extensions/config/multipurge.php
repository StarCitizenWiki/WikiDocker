<?php

$wgMultiPurgeCloudFlareZoneId = null;
$wgMultiPurgeCloudFlareApiToken = null;
$wgMultiPurgeCloudFlareAccountId = null;

$wgMultiPurgeVarnishServers = ['http://star-citizen.wiki-varnish'];
$wgMultiPurgeEnabledServices = ['cloudflare', 'varnish'];
$wgMultiPurgeServiceOrder= ['varnish', 'cloudflare'];

$wgMultiPurgeStaticPurges = [
    'Load Script' => 'load.php?lang=de&modules=startup&only=scripts&raw=1&skin=citizen'
];

$wgMultiPurgeRunInQueue = false;