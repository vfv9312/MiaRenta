<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Utility
{
    public static function sendEmail($email, $model)
    {
        Mail::to($email)->send($model);
    }

    public static function saveFile($file, $path)
    {
        if ($file) {
            $uuid = uniqid();
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . $uuid . '.' . $extension;
            $disk = Storage::disk('public');

            $relativePath = ltrim($path, '/');
            if (!$disk->exists($relativePath)) {
                $disk->makeDirectory($relativePath);
            }

            $storedPath = Storage::disk('public')->putFileAs($relativePath, $file, $fileName);
            return 'storage/' . ltrim($storedPath, '/');
        }
        return '';
    }
}
