<?php

$wgVisualEditorParsoidAutoConfig = true;

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

$wgDefaultUserOptions['visualeditor-enable'] = 1;

$wgVisualEditorEnableWikitext = true;
$wgDefaultUserOptions['visualeditor-newwikitext'] = 1;
