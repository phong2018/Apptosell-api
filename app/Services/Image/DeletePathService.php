<?php

namespace App\Services\Image;

use App\Common\Image as CommonImage;
use App\Models\Traits\Image;
use Illuminate\Support\Facades\Storage;
use Mi\L5Core\Services\BaseService;

class DeletePathService extends BaseService
{
    use Image;
    protected $collectsData = true;

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if ($this->data->get('images')) {
            $cacheImages = collect($this->data->get('images'))->map(function ($item) {
               return CommonImage::CACHE_PATH . $item;
            })->toArray();
            Storage::delete($this->data->get('images'));
            Storage::delete($cacheImages);
        }

        if ($this->data->get('directories')) {
            foreach($this->data->get('directories') as $directory) {
                Storage::deleteDirectory($directory);
                Storage::deleteDirectory(CommonImage::CACHE_PATH . $directory);
            }
        }
    }
}
