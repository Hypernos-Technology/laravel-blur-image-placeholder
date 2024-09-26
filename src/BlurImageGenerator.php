<?php

namespace HypernosTechnology\LaravelBlurImagePlaceholder;

use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class BlurImageGenerator
{
    protected string $imagePath;

    public static function make(string $imagePath): self
    {
        $static = new static();

        return $static->setImagePath($imagePath);
    }

    public function setImagePath(string $imagePath): self
    {
        if (!str($imagePath)->startsWith(storage_path('/app/public'))) {
            throw new Exception('Image path given should use the storage_path(\'/app/public\') function.');
        }

        $this->imagePath = $imagePath;

        return $this;
    }

    public function generate(): void
    {
        $imagePath = $this->imagePath;

        $image = ImageManager::imagick()->read($imagePath);

        $width = $image->width();
        $height = $image->height();

        if ($width > $height) {
            $image->scale(width: 10);
        } else {
            $image->scale(height: 10);
        }

        $image->blur(2);

        $image_data = (string)$image->toJpeg();

        $new_image_path = str($this->imagePath)
            ->replaceStart(storage_path('/app/public/'), '');

        // save to imaginary data service
        Storage::disk('public')
            ->put('/caches/' . $new_image_path, $image_data);
    }
}