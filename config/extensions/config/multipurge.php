<?php

$wgMultiPurgeCloudFlareZoneId = null;
$wgMultiPurgeCloudFlareApiToken = null;
$wgMultiPurgeCloudFlareAccountId = null;

$wgMultiPurgeVarnishServers = ['star-citizen.wiki-varnish'];
$wgMultiPurgeEnabledServices = ['cloudflare', 'varnish'];
$wgMultiPurgeServiceOrder= ['varnish', 'cloudflare'];
