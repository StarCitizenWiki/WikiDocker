<?php

$ceAllowConfirmedEmail = true;

## Rate Limit - 100 Versuche pro Tag
$wgRateLimits['badcaptcha']['newbie'] = [100, 86400];

## QuestyCaptcha
$captchaRSIQuestion = [
    ['R', 'Roberts'],
    ['S', 'Space'],
    ['I', 'Industries'],
];
$captchaRSIRnd = rand(0, 2);
$wgCaptchaQuestions = [
    "<hr>Wofür steht das {$captchaRSIQuestion[$captchaRSIRnd][0]} in RSI?" => $captchaRSIQuestion[$captchaRSIRnd][1],
    '<hr>Wie heißt der Schiffshersteller des Raumschiffes <a href="/300i" target="_blank">300i</a>?' => [
        'Origin Jumpworks',
        'OriginJumpworks',
    ],
    '<hr>Wie heißt der Visionär hinter Star Citizen?' => [
        'Chris Roberts',
    ],
];

## Captcha triggers
$wgCaptchaTriggers['edit'] = false;
$wgCaptchaTriggers['create'] = false;

$wgCaptchaTriggers['addurl'] = true;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin'] = true;
