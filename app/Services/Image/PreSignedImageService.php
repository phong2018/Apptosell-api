<?php

namespace App\Services\Image;

use App\Common\Image;
use Mi\L5Core\Services\BaseService;

class PreSignedImageService extends BaseService
{
    protected $collectsData = true;

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $data = $this->data->all();
        return Image::getPreSigned($data['file_name'], $data['path']);
    }
}
