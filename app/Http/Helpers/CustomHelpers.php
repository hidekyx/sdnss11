<?php

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