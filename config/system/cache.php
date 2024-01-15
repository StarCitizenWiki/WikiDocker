<?php
/** @see RedisBagOStuff for a full explanation of these options. * */

$wgObjectCaches['redis'] = [
    'class' => 'RedisBagOStuff',
    'servers' => [ '10.16.0.8:6379' ],
    'persistent' => true,
];

$wgJobTypeConf['default'] = [
    'class' => 'JobQueueRedis',
    'redisServer' => '10.16.0.8:6379',
    'redisConfig' => [
        'connectTimeout' => 2,
        'compression' => 'gzip',
    ],
    'claimTTL' => 3600,
    'daemonized' => true
];


$wgMainCacheType = 'redis';
$wgParserCacheType = CACHE_DB;
$wgSessionCacheType = 'redis';
$wgMainStash = 'redis';

$wgEnableSidebarCache = true;
$wgUseLocalMessageCache = true;
$wgUseFileCache = false;

$wgParserCacheExpireTime = 2592000;
$wgObjectCacheSessionExpiry = 3600 * 3;

$wgUseCdn = true;

//$wgCdnServers = [
//    '172.16.0.2',
//];

$wgFileCacheDirectory = '/var/www/cache';
$wgCacheDirectory  = "/var/www/cache/$wgDBname";

$wgUsePrivateIPs = true;
$wgCdnServersNoPurge = [
    '10.0.0.0/8',
    '172.16.0.0/29',
    '173.245.48.0/20',
    '103.21.244.0/22',
    '103.22.200.0/22',
    '103.31.4.0/22',
    '141.101.64.0/18',
    '108.162.192.0/18',
    '190.93.240.0/20',
    '188.114.96.0/20',
    '197.234.240.0/22',
    '198.41.128.0/17',
    '162.158.0.0/15',
    '104.16.0.0/13',
    '104.24.0.0/14',
    '172.64.0.0/13',
    '131.0.72.0/22',
    '2400:cb00::/32',
    '2606:4700::/32',
    '2803:f800::/32',
    '2405:b500::/32',
    '2405:8100::/32',
    '2a06:98c0::/29',
    '2c0f:f248::/32',
];
