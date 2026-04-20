<?php

require 'vendor/autoload.php';

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

try {
    $manager = new ImageManager(new Driver());
    
    // Test decode instead of read
    $image = $manager->decode('public/images/logo.png');
    echo "Dimensions: " . $image->width() . "x" . $image->height() . "\n";
    
    $maxWidth = 100;
    if ($image->width() > $maxWidth) {
        $image->scaleDown(width: $maxWidth);
    }
    
    // Encode as JPEG
    $encoded = $image->encode(new \Intervention\Image\Encoders\JpegEncoder(quality: 75));
    echo "Encoding successful, size: " . strlen((string)$encoded) . "\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
