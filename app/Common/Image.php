<?php

namespace App\Common;

use App\Enums\ExceptionTypes;
use App\Exceptions\BusinessException;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\Image as ImageTrait;
use Carbon\Carbon;
use App\Common\Timezone;
use Intervention\Image\Facades\Image as ImageResize;

class Image
{
    const CACHE_PATH = 'cache/';
    const IMAGES_PATH = 'images/';
    const TMP_PATH = 'tmp';
    const TMP_EXPIRED = '+4 hours';
    use ImageTrait;
    /**
     * Upload image to server with file
     *
     * @param Object $file
     * @param Array $options
     * @param String $name
     * @param String $prefix
     * @return string
     */
    public static function generateStorageImage($file, $options = [], $name = null, $path = '')
    {
        if (!$path) {
            $path = self::IMAGES_PATH . 'dates/'  . Carbon::now()->tz(Timezone::TIMEZONE_DEFAULT)->format('Y-m-d') . '/' . time() . uniqid();
        }

        $filename = $file->getClientOriginalName();
        if (!empty($name)) {
            $extension = $file->clientExtension();
            if (empty($extension)) {
                $extension = $file->getClientOriginalExtension();
                if (empty($extension)) {
                    $parse = explode('.', $file->getClientOriginalName());
                    $extension = end($parse);
                }
            }
            $filename = $name . '.' . $extension;
        }

        Storage::putFileAs(
            $path,
            $file,
            $filename,
            array_merge(['visibility' => 'private'], $options)
        );

        return $path . '/' . $filename;
    }

    /**
     * delete image on server
     *
     * @param String $prefix
     * @return boolean
     */
    public static function deleteStorageImage($path = null)
    {
        if (!$path || !Storage::exists($path)) {
            return true;
        }
        return Storage::delete($path);
    }

    /**
     * delete array image on S3
     *
     * @param String $prefix
     * @return boolean
     */
    public static function deleteStorageImages($path = [])
    {
        return Storage::delete($path);
    }

    /**
     * clone image from server with path
     *
     * @param String $file
     * @param String $prefix
     * @return string
     */
    public static function cloneImage($file, $prefix = 'images/')
    {
        throw_if(
            !Storage::exists($file),
            new BusinessException(ExceptionTypes::NOT_FOUND_IMAGE)
        );

        $path = $prefix . time() . uniqid();
        $info = pathinfo($file);
        $filename = $info['filename']. '.' .$info['extension'];
        $copy = Storage::copy($file, $path . '/' . $filename);

        throw_if(
            !$copy,
            new BusinessException(ExceptionTypes::NOT_FOUND_IMAGE)
        );

        return $path . '/' . $filename;
    }

    /**
     * remove tmp images folder
     *
     * @param int $days
     * @return String
     */

    public static function removeImagesTempPath($path)
    {
        return substr($path, 15);
    }

    /**
     * create PreSigned to S3 with tmp folder
     *
     * @param String $file_name
     * @param String $path
     * @param String $prefix
     * @return array
     */
    public static function getPreSigned($file_name, $path)
    {
        $path = self::IMAGES_PATH . trim($path, '/') . '/' . time() . '-' . trim($file_name, '/');
        $client = self::s3Client();

        $command = $client->getCommand('PutObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $path,
        ]);

        $request = $client->createPresignedRequest($command, self::TMP_EXPIRED);

        return [
            'image' => $path,
            'pre_signed' => (string) $request->getUri(),
        ];
    }

    /**
     * move image from server with path
     *
     * @param String $source
     * @param String $destination
     * @return boolean
     */
    public static function moveImage($source, $destination)
    {
        return Storage::move($source, $destination);
    }

    public static function createCacheImageIfNotExist($imagePath)
    {
        $cacheImage = self::CACHE_PATH . $imagePath;
        if (Storage::exists($cacheImage)) {
            return $cacheImage;
        }

        $img = ImageResize::make(Storage::get($imagePath));
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put($cacheImage, $img->stream());

        return $cacheImage;
    }
}
