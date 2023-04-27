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

$wgCdnServersNoPurge = [
    '127.0.0.1',
    '172.16.0.2',
];

$wgFileCacheDirectory = '/var/www/cache';
$wgCacheDirectory  = "/var/www/cache/$wgDBname";