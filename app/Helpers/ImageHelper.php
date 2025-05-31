<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

class ImageHelper
{
    /**
     * Resize & compress image sampai file size target tercapai.
     *
     * @param string $path      Path file image
     * @param int $maxWidth     Resize lebar gambar maksimal (optional, null untuk skip resize)
     * @param float $sizeRatio  Target size ratio (misal 0.8 untuk 80%)
     * @param int $minQuality   Minimal quality yang diizinkan
     * @return int              Final file size dalam byte
     */
    public static function compressToTargetSize($path, $maxWidth = null, $sizeRatio = 0.8, $minQuality = 50)
    {
        if (!file_exists($path)) {
            throw new \Exception("File tidak ditemukan: $path");
        }

        $image = Image::make($path);

        // Resize kalau maxWidth diset
        if ($maxWidth) {
            $image->resize($maxWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $originalSize = filesize($path);
        $targetSize = $originalSize * $sizeRatio;

        $quality = 90; // starting quality
        do {
            $image->save($path, $quality);
            $currentSize = filesize($path);
            $quality -= 5;
        } while ($currentSize > $targetSize && $quality >= $minQuality);

        return $currentSize;
    }
}
