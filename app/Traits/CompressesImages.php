<?php

namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait CompressesImages
{
    /**
     * Compress an uploaded image as JPEG and store it.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int $quality
     * @param int $maxWidth
     * @return string Path to the stored image
     */
    public function compressAndStore(UploadedFile $file, $folder, $quality = 75, $maxWidth = 1920)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->decode($file);

        // Resize down if it exceeds max width, preserving aspect ratio
        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        // Encode as JPEG
        $encoded = $image->encode(new JpegEncoder(quality: $quality));

        // Generate unique filename
        $filename = uniqid('img_', true) . '.jpg';
        $path = $folder . '/' . $filename;

        // Store to public disk
        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }
}
