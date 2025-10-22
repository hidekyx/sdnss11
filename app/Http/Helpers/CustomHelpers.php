<?php

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

if (!function_exists('storeFile')) {
    function storeFile($file, $destinationPath)
    {
        $filename = md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension();
        $file->storeAs($destinationPath, $filename);
        return $filename;
    }
}

if (!function_exists('createThumbnail')) {
    function createThumbnail($file, $destinationPath)
    {
        $thumbnail = ImageManager::gd()->read($file);
        $thumbnail->scale(400, 200);

        $filename = md5(uniqid() . time()) . '-thumbnail.' . $file->getClientOriginalExtension();
        $thumbnail->save('storage/images/berita/thumbnail/' . $filename);
        return $filename;
    }
}

if (!function_exists('storeBeritaImage')) {
    function storeBeritaImage($file, $destinationPath)
    {
        $manager = new ImageManager(new Driver());

        $filename = md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension();
        $savePath = storage_path('app/public/' . $destinationPath . '/' . $filename);
        $image = $manager->read($file->getRealPath());

        $watermarkPath = public_path('images/layout/watermark.png');
        if (file_exists($watermarkPath)) {
            $watermark = $manager->read($watermarkPath);
            $watermark->scale(width: $image->width() / 5);
            $image->place($watermark, 'bottom-right', 10, 10);
        }

        $image->save($savePath);
    }
}