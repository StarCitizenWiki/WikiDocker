<?php

$wgUploadDirectory = "{$IP}/images";

$wgLocalFileRepo = [
    'class' => \MediaWiki\Extension\WebP\Repo\LocalWebPFileRepo::class,
    'name' => 'local',
    'directory' => $wgUploadDirectory,
    'scriptDirUrl' => $wgScriptPath,
    'url' => $wgUploadPath,
    'hashLevels' => 2,
    'thumbScriptUrl' => false,
    'transformVia404' => !true,
    'deletedDir' => "{$wgUploadDirectory}/deleted",
    'deletedHashLevels' => 3
];

$wgWebPConvertInJobQueue = true;
$wgWebPEnableConvertOnUpload = true;
$wgWebPEnableConvertOnTransform = true;
