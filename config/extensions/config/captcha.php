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
$captchaRSIRnd = mt_rand(0, 2);

$captchaSCQuestion = [
    ['S', 'Star'],
    ['C', 'Citizen'],
];
$captchaSCRnd = mt_rand(0, 1);

$wgCaptchaQuestions = [
    "<hr>Wie heißt das Wort, welches mit '{$captchaRSIQuestion[$captchaRSIRnd][0]}' beginnt in <code>Roberts Space Industries</code>?" => [
        $captchaRSIQuestion[$captchaRSIRnd][1],
    ],
    "<hr>Wie heißt das Wort, welches mit '{$captchaSCRnd[$captchaSCRnd][0]}' beginnt in <code>Star Citizen</code>?" => [
        $captchaSCQuestion[$captchaSCRnd][1],
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
