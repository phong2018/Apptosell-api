<?php

namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;
use Mi\L5Core\Services\BaseService;
use App\Common\Image as CommonImage;
use App\Models\Traits\Image;
use Illuminate\Support\Str;

class ListImageService extends BaseService
{
    use Image;
    protected $collectsData = true;

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $images = collect(Storage::files($this->data->get('path')))->map(function ($item) {
            if (basename($item) != 'default_new_folder_name.png') {
                $cacheItem = CommonImage::createCacheImageIfNotExist($item);
                return [
                    $item,
                    $this->generateUrl($item, true),
                    $this->generateUrl($cacheItem, true),
                    Str::slug($item),
                ];
            }
        })->filter(function ($item) {
            return $item != null;
        });

        return [
            'images' => $images,
            'directories' => Storage::directories($this->data->get('path'))
        ];
    }
}
