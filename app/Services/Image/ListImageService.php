<?php

namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;
use Mi\L5Core\Services\BaseService;
use App\Models\Traits\Image;

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
            $cacheItem = $this->createCacheImageIfNotExist(Storage::get($item));
            return [
                $item,
                $this->generateUrl($item),
                $this->generateUrl($cacheItem),
            ];
        });

        return [
            'images' => $images,
            'directories' => Storage::directories($this->data->get('path'))
        ];
    }
}
