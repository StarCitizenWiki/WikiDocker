<?php

use CirrusSearch\CirrusSearch;

wfLoadExtension( 'SemanticMediaWiki' );
enableSemantics( 'star-citizen.wiki' );
wfLoadExtension( 'SemanticResultFormats' );
wfLoadExtension( 'SemanticScribunto' );
wfLoadExtension( 'SemanticDrilldown' );
wfLoadExtension( 'SemanticExtraSpecialProperties' );

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

$smwgDefaultStore = 'SMWElasticStore';
$smwgElasticsearchEndpoints = [ 'smw-elasticsearch:9200' ];

$wgSearchType = 'SMWSearch';

$smwgFallbackSearchType = static function() {
    return new CirrusSearch();
};

$smwgConfigFileDir = '/var/www/smw-config';

$sespgEnabledPropertyList = [
    '_PAGELGTH',
    '_SUBP',
    '_USEREDITCNT',
    '_PAGEIMG',
];

$sespgExcludeBotEdits = true;
$sespgUseFixedTables = true;