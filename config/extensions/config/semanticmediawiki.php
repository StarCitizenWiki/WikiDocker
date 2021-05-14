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

# Experimental Caching
$smwgMainCacheType = 'redis';
$smwgQueryResultCacheType = 'redis';
$smwgQueryResultCacheLifetime = 60 * 60 * 24 * 7;

$smwgEnabledQueryDependencyLinksStore = true;

$smwgQFilterDuplicates = true;
