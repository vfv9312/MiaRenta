<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

            // Si es imagen y pesa más de 2MB (2048 KB), procesamos
            if (str_starts_with($file->getMimeType(), 'image/') && $file->getSize() > 2 * 1024 * 1024) {
                $img = Image::make($file->getRealPath());

                // Redimensionamos a un máximo de 1920px de ancho/alto manteniendo proporción
                $img->resize(1920, 1920, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Guardamos con calidad optimizada
                $disk->put($relativePath . '/' . $fileName, (string) $img->encode($extension, 80));
                return 'storage/' . $relativePath . '/' . $fileName;
            }
            //aqui acaba lo de  2MB

            $storedPath = Storage::disk('public')->putFileAs($relativePath, $file, $fileName);
            return 'storage/' . ltrim($storedPath, '/');
        }
        return '';
    }

    public static function saveToPublic($file, $path)
    {
        if ($file) {
            $uuid = uniqid();
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . $uuid . '.' . $extension;

            $relativePath = ltrim($path, '/');
            $destinationPath = public_path($relativePath);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Si es imagen y pesa más de 2MB, procesamos
            if (str_starts_with($file->getMimeType(), 'image/') && $file->getSize() > 2 * 1024 * 1024) {
                $img = Image::make($file->getRealPath());

                $img->resize(1920, 1920, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->save($destinationPath . '/' . $fileName, 80);
            } else {
                copy($file->getRealPath(), $destinationPath . '/' . $fileName);
            }

            return $relativePath . '/' . $fileName;
        }
        return '';
    }
}
