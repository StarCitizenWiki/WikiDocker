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

$wgUseFileCache = false;
$wgFileCacheDirectory = '/var/www/cache';
