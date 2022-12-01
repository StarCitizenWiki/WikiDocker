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
    '127.0.0.1',
    '172.16.0.4',
];

$wgUseFileCache = false;
$wgFileCacheDirectory = '/var/www/cache';

$wgCacheDirectory  = "/var/www/cache/$wgDBname";
