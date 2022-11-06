<?php

namespace App\Models\Traits;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;

trait Image
{
    public function generateUrl($path, $isFilePublic = false)
    {
        try {
            if (is_null($path) || empty($path)) {
                return '';
            }

            if ($isFilePublic) {
                return Storage::url($path);
            }

            return Storage::temporaryUrl(
                $path,
                now()->addMinutes(15)
            );
        } catch (\Throwable $th) {
            return '';
        }
    }

    public static function s3Client()
    {
        $config = [
            'endpoint' => config('filesystems.disks.s3.endpoint'),
            'region' => config('filesystems.disks.s3.region'),
            'version' => 'latest'
        ];

        return new S3Client($config);
    }
}
