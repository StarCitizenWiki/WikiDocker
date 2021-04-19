<?php

$wgDiscordIncomingWebhookUrl = "";

$wgDiscordFromName = 'Star Citizen Wiki';
$wgDiscordAvatarUrl = 'https://cdn.star-citizen.wiki/images/favicon.png';

$wgDiscordNotificationWikiUrl = 'https://star-citizen.wiki/';

$wgDiscordIncludePageUrls = true;
$wgDiscordIncludeUserUrls = true;
$wgDiscordIgnoreMinorEdits = true;

$wgDiscordIncludeDiffSize = true;

// If this is set, actions by users with this permission won't cause alerts
#$wgDiscordExcludedPermission = "";

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
