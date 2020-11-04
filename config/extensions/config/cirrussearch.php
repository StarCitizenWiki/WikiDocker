<?php

/**
 * Sets up decently fully features cirrus configuration that relies on some of
 * the stuff installed by MediaWiki-Vagrant.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

// https://raw.githubusercontent.com/wikimedia/mediawiki-extensions-CirrusSearch/master/tests/jenkins/FullyFeaturedConfig.php
$wgCirrusSearchQueryStringMaxDeterminizedStates = 500;

$wgCirrusSearchNamespaceResolutionMethod = 'utr30';

$wgCirrusSearchUseCompletionSuggester = 'yes';
$wgCirrusSearchCompletionSuggesterUseDefaultSort = true;
$wgCirrusSearchCompletionSuggesterSubphrases = [
    'use' => true,
    'build' => true,
    'type' => 'anywords',
    'limit' => 10,
];

$wgCirrusSearchPhraseSuggestReverseField = [
    'build' => true,
    'use' => true,
];

// Set defaults to BM25 and the new query builder
$wgCirrusSearchSimilarityProfile = 'bm25_browser_tests';
$wgCirrusSearchFullTextQueryBuilderProfile = 'browser_tests';

$wgCirrusSearchIndexDeletes = true;
$wgCirrusSearchEnableArchive = true;

# Search
$wgCirrusSearchServers = [ 'elasticsearch' ];
$wgSearchType = 'CirrusSearch';
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
