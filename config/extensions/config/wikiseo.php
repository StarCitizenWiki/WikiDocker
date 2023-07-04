<?php

$wgGoogleSiteVerificationKey = '28VBECpznA_OB2SI1Lx2qcwLtCnWauGZrOx_qfCTqDs';
$wgTwitterSiteHandle = '@SC_Wiki';
$wgWikiSeoDefaultLanguage = 'de-de';

$wgDefaultRobotPolicy = 'index,follow';
$wgNamespaceRobotPolicies = [
	NS_MAIN => 'index,follow',
	NS_FILE => 'index,follow',
	NS_COMMLINK => 'index,follow',
	NS_ORGANISATION => 'index,follow',
	NS_COMMUNITY_CONTENT => 'index,follow',
];

$wgWikiSeoNoindexPageTitles = [
	'Spezial:Anmelden',
	'Spezial:Zufällige_Seite',
	'Spezial:Suche',
	'Spezial:Benutzerkonto_anlegen',
];
$wgWikiSeoEnableAutoDescription = true;
$wgWikiSeoEnableSocialImages = true;
$wgWikiSeoSocialImageIcon = 'Star Citizen Wiki Stern.png';
