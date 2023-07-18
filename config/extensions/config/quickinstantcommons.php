<?php

$wgUseQuickInstantCommons = false;
$wgForeignFileRepos[] = [
    'class' => '\MediaWiki\Extension\QuickInstantCommons\Repo',
    'name' => 'toolswiki', // Must be a distinct name
    'directory' => $wgUploadDirectory, // FileBackend needs some value here.
    'apibase' => 'https://starcitizen.tools/api.php',
    'hashLevels' => 2, // Important this matches foreign repo if 404 transform enabled.
    'thumbUrl' => false, // Set to false to auto-detect
    'fetchDescription' => true, // Optional
    'descriptionCacheExpiry' => 3600*24*7, // 12 hours, optional (values are seconds). This cache is not adaptive.
    'transformVia404' => false, // Whether foreign repo supports 404 transform. Much faster if supported
    'abbrvThreshold' => 255, // must match what foreign repo uses if 404 transform enabled. Default is 255. Wikimedia uses 160.
    'apiMetadataExpiry' => 60*60*24, // Max time metadata is cached for. Recently changed items are cached for less
    'disabledMediaHandlers' => [TiffHandler::class] // media handler extensions to not use. For 404 handling its important that the local media handler extensions match the foreign ones.
];