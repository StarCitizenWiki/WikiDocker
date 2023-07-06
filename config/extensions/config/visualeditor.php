<?php

$wgVisualEditorAvailableNamespaces = [
    NS_MAIN => true,
    NS_USER => true,
    NS_COMMLINK => true,
    NS_HELP => true,
    NS_PROJECT => true,
    NS_ORGANISATION => true,
    NS_COMMUNITY_CONTENT => true,
    NS_UPDATE => true,
    '_merge_strategy' => 'array_plus'
];

$wgDefaultUserOptions['visualeditor-newwikitext'] = 1;
$wgDefaultUserOptions['visualeditor-editor'] = 'visualeditor';

$wgVisualEditorEnableWikitext = true;
$wgVisualEditorEnableDiffPage = true;
$wgVisualEditorUseSingleEditTab = true;
