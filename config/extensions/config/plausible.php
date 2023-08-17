<?php

$wgPlausibleDomain = 'https://analytics.star-citizen.wiki';
$wgPlausibleDomainKey = 'star-citizen.wiki';
$wgPlausibleApiKey = getenv( 'EXT_PLAUSIBLE_KEY' );

$wgPlausibleTrackOutboundLinks = true;
$wgPlausibleTrackLoggedIn = true;
$wgPlausibleHonorDNT = false;
$wgPlausibleIgnoredTitles = [];

$wgPlausibleTrack404 = true;
$wgPlausibleTrackEditButtonClicks = false;
$wgPlausibleTrackSearchInput = false;
$wgPlausibleTrackCitizenSearchLinks = true;
$wgPlausibleTrackCitizenMenuLinks = true;
$wgPlausibleTrackNavplateClicks = true;
$wgPlausibleTrackInfoboxClicks = true;
