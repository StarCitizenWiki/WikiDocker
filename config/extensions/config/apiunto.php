<?php

$wgApiuntoSources = [
    'StarCitizenWikiAPI' => [
        'baseUrl' => 'https://api.star-citizen.wiki/api/',
        'token' => getenv( 'EXT_APIUNTO_KEY' ),
        'timeout' => 60,
        'cacheDuration' => 86400,
        'followRedirects' => false,
    ],
];
