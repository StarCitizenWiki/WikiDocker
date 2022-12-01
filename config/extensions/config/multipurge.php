<?php

$wgMultiPurgeCloudFlareZoneId = null;
$wgMultiPurgeCloudFlareApiToken = null;
$wgMultiPurgeCloudFlareAccountId = null;

$wgMultiPurgeVarnishServers = ['star-citizen.wiki-varnish:80'];
$wgMultiPurgeEnabledServices = ['cloudflare', 'varnish'];
$wgMultiPurgeServiceOrder= ['varnish', 'cloudflare'];
