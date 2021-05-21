<?php
# Search
## This loads Elastica and sets wgSearchType
require_once "/var/www/html/extensions/CirrusSearch/tests/jenkins/FullyFeaturedConfig.php";

wfLoadExtension( 'CirrusSearch' );

$wgCirrusSearchServers = [ 'elasticsearch' ];

$wgNamespacesToBeSearchedDefault = [
    NS_MAIN =>           true,
    NS_TALK =>           false,
    NS_USER =>           false,
    NS_USER_TALK =>      false,
    NS_PROJECT =>        true,
    NS_PROJECT_TALK =>   false,
    NS_FILE =>           true,
    NS_FILE_TALK =>      false,
    NS_MEDIAWIKI =>      false,
    NS_MEDIAWIKI_TALK => false,
    NS_TEMPLATE =>       true,
    NS_TEMPLATE_TALK =>  false,
    NS_HELP =>           true,
    NS_HELP_TALK =>      false,
    NS_CATEGORY =>       true,
    NS_CATEGORY_TALK =>  false,

    NS_COMMLINK =>       true,
    NS_COMMLINK_TALK =>  false,

    NS_TRANSCRIPT =>     true,

    NS_ORGANISATION =>   true,

    NS_COMMUNITY_CONTENT =>   true,
];

wfLoadExtension( 'AdvancedSearch' );
