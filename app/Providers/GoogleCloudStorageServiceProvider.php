<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\FilesystemAdapter;

class GoogleCloudStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function boot()
    {
        Storage::extend('gcs', function ($app, $config) {

            $storageClient = new StorageClient([
                'projectId' => $config['project_id'],
                'keyFilePath' => $config['key_file_path'] ?? null,
            ]);

            $bucket = $storageClient->bucket($config['bucket']);

            $adapter = new GoogleCloudStorageAdapter($bucket, $config['path_prefix'] ?? '');

            return new FilesystemAdapter(
                new Filesystem($adapter),
                $adapter,
                $config
            );
        });
    }

    // public function boot()
    // {
    //     Storage::extend('gcs', function ($app, $config) {
    //         $storageClient = new StorageClient([
    //             'projectId' => $config['project_id'],
    //             'keyFilePath' => $config['key_file_path'] ?? null,
    //             // 'keyFile' => $config['key_file'] ?? null,
    //         ]);

    //         $bucket = $storageClient->bucket($config['bucket']);
    //         $adapter = new GoogleCloudStorageAdapter($bucket, $config['path_prefix'] ?? '');

    //         $flysystem = new Filesystem($adapter, $config);

    //         return new FilesystemAdapter($flysystem, $adapter, $config);

    //     });
    // }
}
