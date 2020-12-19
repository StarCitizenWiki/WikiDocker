<?php

// Enables WebP creation after a new image was uploaded
$wgWebPEnableConvertOnUpload = false;

// Enables WebP creation after a thumbnail was created
$wgWebPEnableConvertOnTransform = false;

// Compression quality of the image: 0 - 100 where 100 means most compressed
$wgWebPCompressionQuality = 50;

// the strength of the deblocking filter, between 0 (no filtering) and 100 (maximum filtering). A value of 0 turns off any filtering.
// Higher values increase the strength of the filtering process applied after decoding the image.
// The higher the value, the smoother the image appears. Typical values are usually in the range of 20 to 50.
$wgWebPFilterStrength = 50;

// when enabled, the algorithm spends additional time optimizing the filtering strength to reach a well-balanced quality.
$wgWebPAutoFilter = true;

// Create images through the JobQueue
$wgWebPConvertInJobQueue = true;
