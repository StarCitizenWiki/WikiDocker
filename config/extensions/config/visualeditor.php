<?php

#$wgVisualEditorParsoidAutoConfig = true;
$wgVirtualRestConfig['modules']['parsoid'] = [
    // URL to the Parsoid instance.
    // You should change $wgServer to match the non-local host running Parsoid
    'url' => 'https://star-citizen.wiki/rest.php',
    // Parsoid "domain", see below (optional, rarely needed)
    'domain' => 'star-citizen.wiki',
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

$wgDefaultUserOptions['visualeditor-enable'] = 1;

$wgVisualEditorEnableWikitext = true;
$wgDefaultUserOptions['visualeditor-newwikitext'] = 1;
