<?php

use CirrusSearch\CirrusSearch;

enableSemantics( 'star-citizen.wiki' );
wfLoadExtension( 'SemanticResultFormats' );
wfLoadExtension( 'SemanticScribunto' );

$smwgFallbackSearchType = static function() {
    return new CirrusSearch();
};

$smwgSearchByPropertyFuzzy = false;

$smwgNamespacesWithSemanticLinks[NS_COMMLINK] = true;
$smwgNamespacesWithSemanticLinks[NS_TRANSCRIPT] = true;
$smwgNamespacesWithSemanticLinks[NS_ORGANISATION] = true;
$smwgNamespacesWithSemanticLinks[NS_COMMUNITY_CONTENT] = true;

$smwgQMaxInlineLimit = 2500;
