<?php

$wgParsoidSettings = [
    'useSelser' => true,
    'linting' => true,
];

$wgVisualEditorParsoidAutoConfig = false;

$wgVirtualRestConfig = [
    'paths' => [],
    'modules' => [
        'parsoid' => [
            'url' => 'https://star-citizen.wiki/rest.php',
            'domain' => 'star-citizen.wiki',
            'prefix' => 'scw__wiki_live',
            'forwardCookies' => true,
            'restbaseCompat' => false,
            'timeout' => 30,
        ],
    ],
    'global' => [
        'timeout' => 360,
        'forwardCookies' => false,
        'HTTPProxy' => null,
    ],
];
