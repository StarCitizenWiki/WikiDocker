<?php

$wgDiscordIncomingWebhookUrl = "";

$wgDiscordFromName = 'Wiki Changelog Bot';
$wgDiscordAvatarUrl = 'https://cdn.star-citizen.wiki/images/favicon.png';

$wgDiscordNotificationWikiUrl = 'https://star-citizen.wiki/';

$wgDiscordExcludeNotificationsFrom = [
    'User:',
    'Benutzer:',
    'Modul:',
    'Module:',
    'Vorlage:',
    'Template:',
];

$wgDiscordIncludePageUrls = true;
$wgDiscordIncludeUserUrls = false;
$wgDiscordIgnoreMinorEdits = false;

$wgDiscordIncludeDiffSize = true;

// If this is set, actions by users with this permission won't cause alerts
$wgDiscordExcludedPermission = 'sysop';

// New user added into MediaWiki
$wgDiscordNotificationNewUser = true;
$wgDiscordShowNewUserFullName = false;

// User or IP blocked in MediaWiki
$wgDiscordNotificationBlockedUser = false;

// User groups changed in MediaWiki
$wgDiscordNotificationUserGroupsChanged = false;

// Article added to MediaWiki
$wgDiscordNotificationAddedArticle = true;

// Article removed from MediaWiki
$wgDiscordNotificationRemovedArticle = true;

// Article moved under new title in MediaWiki
$wgDiscordNotificationMovedArticle = true;

// Article edited in MediaWiki
$wgDiscordNotificationEditedArticle = true;

// File uploaded
$wgDiscordNotificationFileUpload = true;

// Article protection settings changed
$wgDiscordNotificationProtectedArticle = false;

// Article has been imported
$wgDiscordNotificationAfterImportPage = false;
