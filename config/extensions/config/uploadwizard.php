<?php
$wgStrictxtensions = true;
$wgCheckFileExtensions = true;
$wgVerifyMimeType = true;
$wgAllowCopyUploads = true;

$wgFileExtensions = ['png', 'gif', 'jpg', 'jpeg', 'ppt', 'pptx', 'pdf', 'psd', 'mp3', 'xls', 'xlsx', 'swf', 'doc', 'docx', 'odt', 'odc', 'odp', 'odg', 'mpp', 'mp4', 'webm', 'zip', 'dae', 'svg', 'ctm', 'ogg', 'acc', 'opus', 'm4a'];

$wgUploadWizardConfig = [
    'debug' => false,
    'enableLicensePreference' => false,
    'autoAdd' => [
        'wikitext' => [],
        'categories' => [],
    ],
    'missingCategoriesWikiText' => '[[Kategorie:Datei mit fehlender Kategorie]]',
    'tutorial' => [
        'skip' => true,
    ],
    'defaults' => [
        'description' => '',
    ],
    'uwLanguages' => [
        'de' => 'Deutsch',
        'en' => 'English'
    ],
    'licenses' => [
        'license-rsi' => [
            'msg' => 'mwe-upwiz-license-rsi',
            'url' => '//robertsspaceindustries.com/tos#fansite_use',
            'languageCodePrefix' => 'deed.'
        ],
        'license-custom-rsi' => [
            'msg' => 'mwe-upwiz-license-custom-rsi',
            'url' => '//robertsspaceindustries.com/tos#fansite_use',
            'languageCodePrefix' => 'deed.'
        ],
        'cc-by-nc-sa-4.0' => [
            'msg' => 'mwe-upwiz-license-cc-by-nc-sa-4.0',
            'icons' => ['cc-by', 'cc-nc', 'cc-sa'],
            'url' => '//creativecommons.org/licenses/by-nc-sa/4.0/',
            'languageCodePrefix' => 'deed.'
        ],
        'cc-by-sa-4.0' => [
            'msg' => 'mwe-upwiz-license-cc-by-sa-4.0',
            'icons' => ['cc-by', 'cc-sa'],
            'url' => '//creativecommons.org/licenses/by-sa/4.0/',
            'languageCodePrefix' => 'deed.'
        ],
        'cc-by-4.0' => [
            'msg' => 'mwe-upwiz-license-cc-by-4.0',
            'icons' => ['cc-by'],
            'url' => '//creativecommons.org/licenses/by/4.0/',
            'languageCodePrefix' => 'deed.'
        ],
        'none' => [
            'msg' => 'mwe-upwiz-license-none',
            'templates' => ['subst:uwl']
        ],
        'custom' => [
            'msg' => 'mwe-upwiz-license-custom',
            'templates' => ['subst:Custom license marker added by UW'],
        ],
        'generic' => [
            'msg' => 'mwe-upwiz-license-generic',
            'templates' => ['Generic']
        ]
    ],

    'licensing' => [
        'ownWork' => [
            'type' => 'or',
            'template' => 'self',
            'defaults' => 'license-custom-rsi',
            'licenses' => [
                'license-custom-rsi',
                'generic',
                'cc-by-sa-4.0',
                'cc-by-nc-sa-4.0',
                'cc-by-4.0',
            ],
        ],
        'thirdParty' => [
            'type' => 'or',
            'defaults' => 'license-rsi',
            'licenseGroups' => [
                [
                    'head' => 'mwe-upwiz-license-starcitizen-head',
                    'licenses' => [
                        'license-rsi',
                    ],
                ],
                [
                    // This should be a list of all CC licenses we can reasonably expect to find around the web
                    'head' => 'mwe-upwiz-license-cc-head',
                    'subhead' => 'mwe-upwiz-license-cc-subhead',
                    'licenses' => [
                        'generic',
                        'cc-by-sa-4.0',
                        'cc-by-nc-sa-4.0',
                        'cc-by-4.0',
                    ],
                ],
                [
                    'head' => 'mwe-upwiz-license-custom-head',
                    'special' => 'custom',
                    'licenses' => ['custom'],
                ],
                [
                    'head' => 'mwe-upwiz-license-none-head',
                    'licenses' => ['none'],
                ],
            ],
        ],
    ],
    'minAuthorLength' => 1,
    'minSourceLength' => 3,
    'alternativeUploadToolsPage' => false,
    'feedbackLink' => false,
    //'altUploadForm' => 'Spezial:Hochladen',
    'enableFormData' => true,
    'enableMultipleFiles' => true,
    'enableMultiFileSelect' => true,
    'fileExtensions' => $wgFileExtensions,
    'maxUploads' => 100
];

$wgExtensionFunctions[] = function () {
    $GLOBALS['wgUploadNavigationUrl'] = SpecialPage::getTitleFor('UploadWizard')->getLocalURL();
    return true;
};

$wgResourceModules['myUploadWizardResources'] = [
    'messages' => [
        'mwe-upwiz-license-rsi',
        'mwe-upwiz-license-custom-rsi',
        'mwe-upwiz-license-starcitizen-head',
        'mwe-upwiz-source-ownwork-assert-license-custom-rsi',
        'mwe-upwiz-source-ownwork-license-custom-rsi-explain',
        'mwe-upwiz-license-cc-by-nc-sa-4.0',
        'mwe-upwiz-license-cc-by-sa-4.0',
        'mwe-upwiz-license-cc-by-4.0',
    ],
];

// Set up a hook to add our resource loader module to every page
function myUploadWizardResourcesLoader(&$out)
{
    $out->addModules('myUploadWizardResources');
    return true;
}

// Register the hook
$wgHooks['BeforePageDisplay'][] = 'myUploadWizardResourcesLoader';
