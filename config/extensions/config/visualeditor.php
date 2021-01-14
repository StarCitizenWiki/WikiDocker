<?php

$wgVisualEditorParsoidAutoConfig = false;

$wgVirtualRestConfig['modules']['parsoid'] = [
    'url' => 'http://parsoid:8000',
    'domain' => 'live',
    'prefix' => 'live',
];

$wgVisualEditorAvailableNamespaces = [
    NS_MAIN => true,
    NS_USER => true,
    NS_COMMLINK => true,
    NS_HELP => true,
    NS_PROJECT => true,
    NS_ORGANISATION => true,
    NS_COMMUNITY_CONTENT => true,
    '_merge_strategy' => 'array_plus'
];


$wgDefaultUserOptions['visualeditor-newwikitext'] = 1;
$wgDefaultUserOptions['visualeditor-editor'] = 'visualeditor';

$wgVisualEditorEnableWikitext = true;
$wgVisualEditorEnableDiffPage = true;
$wgVisualEditorUseSingleEditTab = true;
