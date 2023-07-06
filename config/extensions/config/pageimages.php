<?php

$wgPageImagesNamespaces = [
    NS_MAIN,
    NS_COMMLINK,
];

$wgPageImagesBlacklist = [
    [
        'type' => 'db',
        'page' => 'MediaWiki:Pageimages-blacklist',
        'db' => false,
    ],
];

$wgPageImagesScores['ratio'] = [
    3 => 0,
    5 => 0,
    20 => 5,
    30 => 0,
    31 => 0,
];

$wgPageImagesExpandOpenSearchXml = true;

$wgPageImagesAPIDefaultLicense = 'any';

$wgPageImagesLeadSectionOnly = true;
$wgPageImagesOpenGraph = false;

$wgPageImagesNamespaces = [ NS_MAIN, NS_UPDATE, NS_COMMLINK, NS_ORGANISATION ];