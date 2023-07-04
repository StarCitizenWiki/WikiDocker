<?php

$wgDiscordIncomingWebhookUrl = getenv( 'EXT_DISCORD_WEBHOOK_URL' );

$wgDiscordFromName = 'Wiki Changelog Bot';
$wgDiscordAvatarUrl = 'https://robertsspaceindustries.com/i/3f771270776497cb8f82de39f879bbbfa4838985/ADdPNihJzmPbNuTnFsH1DqUeqBRpXdSXVVtgJTyDDgscGKrzJuoFjResf1QAVQVPZcf7JSUPP7hqmjyJoZCD9LbT4/insidestarcitizen-mesh1-notext.webp';

$wgDiscordNotificationWikiUrl = 'https://star-citizen.wiki/';

$wgDiscordExcludeNotificationsFrom = [
    'User:',
    'Benutzer:',
];

$wgDiscordIncludePageUrls = true;
$wgDiscordIncludeUserUrls = false;
$wgDiscordIgnoreMinorEdits = false;

$wgDiscordIncludeDiffSize = true;

// If this is set, actions by users with this permission won't cause alerts
$wgDiscordExcludedPermission = 'bot';

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
$wgDiscordNotificationProtectedArticle = true;

// Article has been imported
$wgDiscordNotificationAfterImportPage = false;
