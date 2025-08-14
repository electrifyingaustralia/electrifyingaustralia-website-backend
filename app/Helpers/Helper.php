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

    $path = getAssetFolderPath($folder);

    $path .= "/{$filename}";

    if ($disk->exists($path)) return $disk->url($path);

    return null;
}
