<?php
$wgHiddenPrefs[] = 'realname';

## Default Values
$wgDefaultUserOptions['minordefault'] = 0;
$wgDefaultUserOptions['multimediaviewer-enable'] = 1;
$wgDefaultUserOptions['forceeditsummary'] = 1;
$wgDefaultUserOptions['uselivepreview'] = 1;

# Upload Wizard
$wgDefaultUserOptions['upwiz_deflicense'] = 'thirdparty-license-rsi';

# VisualEditor
$wgDefaultUserOptions['visualeditor-enable'] = 1;
$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;
$wgDefaultUserOptions['visualeditor-tabs'] = 'multi-tab';

# WikiEditor
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
$wgDefaultUserOptions['wikieditor-preview'] = 1;
$wgDefaultUserOptions['wikieditor-publish'] = 1;

# Semantic Results Format
$wgDefaultUserOptions['srf-prefs-datatables-options-update-default'] = 0;
$wgDefaultUserOptions['srf-prefs-datatables-options-cache-default'] = 1;

# Cirrus Search
$wgDefaultUserOptions['cirrussearch-pref-completion-profile'] = 'fuzzy-subphrases';

# CodeMirror
$wgDefaultUserOptions['usecodemirror'] = 1;

# Auto Groups
$wgAutoConfirmCount = 250;
$wgAutoConfirmAge = 86400 * 30;

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
#    'smwadministrator',
    'suppress',
    'upwizcampeditors',
    'user',
    'widgeteditor',
#    'SMW-Administratoren',
    'SMW-Kuratoren',
]; //, 'oversight', 'suppress'
