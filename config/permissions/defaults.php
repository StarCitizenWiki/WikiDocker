<?php
## Default Werte
$wgDefaultUserOptions['numberheadings'] = false;
$wgDefaultUserOptions['minordefault'] = false;
$wgDefaultUserOptions['multimediaviewer-enable'] = true;
$wgDefaultUserOptions['forceeditsummary'] = true;
$wgDefaultUserOptions['uselivepreview'] = true;

# Upload Wizard
$wgDefaultUserOptions['upwiz_deflicense'] = 'thirdparty-license-rsi';

# VisualEditor
$wgDefaultUserOptions['visualeditor-enable'] = true;
$wgDefaultUserOptions['visualeditor-enable-experimental'] = true;

# WikiEditor
$wgDefaultUserOptions['usebetatoolbar'] = true;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = true;
$wgDefaultUserOptions['wikieditor-preview'] = true;
$wgDefaultUserOptions['wikieditor-publish'] = true;

# Semantic Results Format
$wgDefaultUserOptions['srf-prefs-datatables-options-update-default'] = false;
$wgDefaultUserOptions['srf-prefs-datatables-options-cache-default'] = true;

# Cirrus Search
$wgDefaultUserOptions['cirrussearch-pref-completion-profile'] = 'fuzzy-subphrases';

# Auto Groups
$wgAutoConfirmCount = 250;
$wgAutoConfirmAge = 86400 * 30;

/*$wgAutopromote = [
    "Mitarbeiter" => ["&",
        APCOND_EMAILCONFIRMED,
        [APCOND_EDITCOUNT, &$wgAutoConfirmCount],
        [APCOND_AGE, &$wgAutoConfirmAge],
        ['!', APCOND_BLOCKED]
    ]
];*/

# Hidden Groups
$wgImplicitGroups = [
    '*',
    'autoconfirmed',
    'emailconfirmed',
    'image-reviewer',
    'Image-reviewer',
#       'notification',
    'oversight',
    'smwcurator',
    'suppress',
    'upwizcampeditors',
    'user',
    'widgeteditor',
]; //, 'oversight', 'suppress'
