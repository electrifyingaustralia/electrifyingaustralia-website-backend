<?php

use Illuminate\Support\Facades\Storage;

function getAssetFolderPath(string $folder, ?string $default = null)
{
    $folder_path = "ea/{$folder}";

    return $folder_path;
}

function getAssetFileUrl(string $folder, string | null $filename = null, $default = null, $disk = "public")
{

    if (is_null($filename)) return $default;

    $storage = Storage::disk($disk);

    $path = "{$folder}/{$filename}";

    if (!$storage->exists($path)) {
        return null;
    }

    if ($disk === 'gcs') {
        return "https://storage.googleapis.com/electrifyingaustralia/$path";
    }

    return $storage->url($path);
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
