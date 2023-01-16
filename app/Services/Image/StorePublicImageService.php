<?php

namespace App\Services\Image;

use App\Common\Image as CommonImage;
use App\Models\Traits\Image;
use Mi\L5Core\Services\BaseService;

class StorePublicImageService extends BaseService
{
    use Image;
    protected $collectsData = true;

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if ($this->data->get('upload')) {
            $imagePath = CommonImage::generateStorageImage($this->data->get('upload'), ['visibility' => 'public'], null, $this->data->get('file_pạth'));
            return [
                'url' => $this->generateUrl($imagePath, true)
            ];
        }

        if ($this->data->get('uploads')) {
            $urls = [];
            foreach ($this->data->get('uploads') as $upload) {
                $urls[] =  $this->generateUrl(CommonImage::generateStorageImage($upload, [], null, $this->data->get('file_pạth')));
            }
            return $urls;
        }
    }
}
