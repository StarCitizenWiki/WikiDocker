<?php

$wgTemplateStylesAllowedUrls = [
    "audio" => [
        "<^https://star-citizen\\.wiki/>",
        "<^https://cdn\\.star-citizen\\.wiki/>",
    ],
    "image" => [
        "<^https://star-citizen\\.wiki/>",
        "<^https://cdn\\.star-citizen\\.wiki/>",
    ],
    "svg" => [
        "<^https://star-citizen\\.wiki/[^?#]*\\.svg(?:[?#]|$)>",
        "<^https://cdn\\.star-citizen\\.wiki/[^?#]*\\.svg(?:[?#]|$)>",
    ],
    "font" => [
        "<^https://star-citizen\\.wiki/>",
        "<^https://cdn\\.star-citizen\\.wiki/>",
    ],
    "namespace" => [
        "<.>"
    ],
    "css" => []
];

$wgTemplateStylesExtenderEnableUnscopingSupport = true;