<?php
/** @see RedisBagOStuff for a full explanation of these options. * */

$wgObjectCaches['redis'] = [
    'class' => 'RedisBagOStuff',
    'servers' => [ 'redis:6379' ],
    'persistent' => true,
];

$wgJobTypeConf['default'] = [
    'class' => 'JobQueueRedis',
    'redisServer' => 'redis:6379',
    'redisConfig' => [
        'connectTimeout' => 2,
        'compression' => 'gzip',
    ],
    'claimTTL' => 3600,
    'daemonized' => true
];

$wgEnableSidebarCache = true;

$wgMainCacheType = 'redis';
$wgSessionCacheType = 'redis';
$wgMainStash = 'redis';

$wgUseLocalMessageCache = true;
$wgParserCacheExpireTime = 2592000;

$wgObjectCacheSessionExpiry = 3600 * 3;

$wgUseCdn = true;
$wgCdnServersNoPurge = [
    '10.0.0.0/8',
    '172.16.0.0/12',
    '192.168.0.0/16',

    // Cloudflare IPv4
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
    '104.16.0.0/12',
    '172.64.0.0/13',
    '131.0.72.0/22',
    // Cloudflare IPv6
    '2400:cb00::/32',
    '2606:4700::/32',
    '2803:f800::/32',
    '2405:b500::/32',
    '2405:8100::/32',
    '2a06:98c0::/29',
    '2c0f:f248::/32',
];

$wgCdnServers = [
    '127.0.0.1',
    '172.16.0.4',
    'star-citizen.wiki-varnish',
];

$wgUseFileCache = true;
$wgFileCacheDirectory = '/var/www/cache';

$wgInternalServer = 'star-citizen.wiki-live';