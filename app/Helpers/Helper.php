<?php

use Illuminate\Support\Facades\Storage;

function getAssetFolderPath(string $folder, ?string $default = null)
{
    $folder_path = "ea/{$folder}";

    return $folder_path;
}

function getAssetFileUrl(string $folder, string | null $filename = null, $default = null)
{

    if (is_null($filename)) return $default;

    $disk = Storage::disk(env('FILESYSTEM_DISK', 'public'));

    $path = "{$folder}/{$filename}";

    if ($disk->exists($path)) return $disk->url($path);

    return null;
}


if (! function_exists('formatFileSize')) {
    function formatFileSize($bytes, $decimals = 2)
    {
        $size = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
    }
}

function formatDate($date, $format = 'M d, Y')
{
    if ($date != null) {
        return $date->format($format);
    } else {
        return 'No date available';
    }
}
