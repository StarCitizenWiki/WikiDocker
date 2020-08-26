<?php

$wgTmhEnableMp4Uploads = true;
$wgEnableTranscode = false;

$wgMediaVideoTypes = [
    'Theora',
    'VP8',
    'H.264'
];

$wgEnabledTranscodeSet = [
#	WebVideoTranscode::ENC_WEBM_480P,
#	WebVideoTranscode::ENC_WEBM_720P,
];

$wgFFmpegLocation = '/usr/bin/ffmpeg';
