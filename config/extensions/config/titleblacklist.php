<?php

$wgEnableDnsBlacklist = true;
$wgTitleBlacklistSources = [
    [
        'type' => 'localpage',
        'src' => 'MediaWiki:Titleblacklist',
    ],
    [
        'type' => 'url',
        'src' => 'https://meta.wikimedia.org/w/index.php?title=Title_blacklist&action=raw',
    ],
];

$wgSpamBlacklistFiles = [
    'https://meta.wikimedia.org/w/index.php?title=Spam_blacklist&action=raw&sb_ver=1',
    'https://en.wikipedia.org/w/index.php?title=MediaWiki:Spam-blacklist&action=raw&sb_ver=1'
];
