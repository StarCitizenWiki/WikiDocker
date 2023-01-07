<?php

$wgMultiPurgeCloudFlareZoneId = null;
$wgMultiPurgeCloudFlareApiToken = null;
$wgMultiPurgeCloudFlareAccountId = null;

$wgMultiPurgeVarnishServers = ['http://star-citizen.wiki-varnish'];
$wgMultiPurgeEnabledServices = ['cloudflare', 'varnish'];
$wgMultiPurgeServiceOrder= ['varnish', 'cloudflare'];
