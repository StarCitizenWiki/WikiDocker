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
$smwgNamespacesWithSemanticLinks[NS_TEMPLATE] = true;
$smwgNamespacesWithSemanticLinks[828] = true;

$smwgQMaxInlineLimit = 2500;

# Experimental Caching
$smwgMainCacheType = 'redis';
$smwgQueryResultCacheType = 'redis';
$smwgQueryResultCacheLifetime = 60 * 60 * 24 * 7;

$smwgEnabledQueryDependencyLinksStore = true;

$smwgQFilterDuplicates = true;

//$smwgDefaultStore = 'SMWElasticStore';
//$smwgElasticsearchEndpoints = [ 'smw-elasticsearch:9200' ];
//
//$wgSearchType = 'SMWSearch';
//
//$smwgFallbackSearchType = static function() {
//    return new CirrusSearch();
//};

$smwgConfigFileDir = '/var/www/smw-config';

$sespgLocalDefinitions['_LINKSTO'] = [
    'id'    => '_LINKSTO',
    'type'  => '_wpg',
    'alias' => 'sesp-property-links-to',
    'desc' => 'sesp-property-links-to-desc',
    'label' => 'Links to',
    'callback'  => static function(\SESP\AppFactory $appFactory, \SMW\DIProperty $property, \SMW\SemanticData $semanticData ) {
        $page = $semanticData->getSubject()->getTitle();

        // The namespaces where the property will be added
        $targetNS = [ 10, 828 ];

        if ( $page === null || !in_array( $page->getNamespace(), $targetNS, true ) ) {
            return;
        }

        /** @var \Wikimedia\Rdbms\DBConnRef $con */
        $con = $appFactory->getConnection();

        $where = sprintf(
            'pl.pl_from = %s AND pl.pl_title != %s',
            $page->getArticleID(),
            $con->addQuotes( $page->getDBkey() )
        );

        $where = [ $where ];

        if ( !empty( $targetNS ) ) {
            $where[] = [ 'pl.pl_namespace' => $targetNS ];
        }

        $res = $con->select(
            [ 'pl' => 'pagelinks', 'page' ],
            [ 'sel_title' => 'pl.pl_title', 'sel_ns' => 'pl.pl_namespace' ],
            $where,
            __METHOD__,
            [ 'DISTINCT' ],
            [ 'page' => [ 'JOIN', 'page_id=pl_from' ] ]
        );

        foreach( $res as $row ) {
            $title = Title::newFromText( $row->sel_title, $row->sel_ns );
            if ( $title !== null && $title->exists() ) {
                $semanticData->addPropertyObjectValue( $property, \SMW\DIWikiPage::newFromTitle( $title ) );
            }
        }
    }
];

$sespgEnabledPropertyList = [
    '_PAGELGTH',
    '_SUBP',
    '_USEREDITCNT',
    '_PAGEIMG',
    '_LINKSTO',
];

$sespgExcludeBotEdits = true;
$sespgUseFixedTables = true;
$sespgDefinitionsFile = '/var/www/config/extensions/sesp-definitions.json';
$smwgEnabledFulltextSearch = true;

