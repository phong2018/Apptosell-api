<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\ListImageRequest;
use App\Http\Requests\Admin\Image\PreSignedImageRequest;
use App\Services\Image\ListImageService;
use App\Services\Image\PreSignedImageService;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preSignedImage(PreSignedImageRequest $request)
    {
        $preSignedImage = resolve(PreSignedImageService::class)->setRequest($request)->handle();
        return response()->success($preSignedImage);
    }

    /**
     * Display a listing of the images in path.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListImageRequest $request)
    {
        $listImages = resolve(ListImageService::class)->setRequest($request)->handle();
        return response()->success($listImages);
    }
}
