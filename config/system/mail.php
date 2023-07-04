<?php

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "info@star-citizen.wiki";
$wgPasswordSender = "noreply@star-citizen.wiki";

$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

$wgAllowHTMLEmail = true;

$wgSMTP = [
    'host' => 'mail.octofox.de',
    'IDHost' => 'star-citizen.wiki',
    'port' => 587,
    'auth' => true,
    'username' => getenv( 'MAIL_USER' ),
    'password' => getenv( 'MAIL_PASSWORD' ),
];
