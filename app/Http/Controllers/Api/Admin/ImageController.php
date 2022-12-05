<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\DeletePathRequest;
use App\Http\Requests\Admin\Image\ListImageRequest;
use App\Http\Requests\Admin\Image\PreSignedImageRequest;
use App\Http\Requests\Admin\Image\StorePublicImageRequest;
use App\Services\Image\DeletePathService;
use App\Services\Image\ListImageService;
use App\Services\Image\PreSignedImageService;
use App\Services\Image\StorePublicImageService;

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

    public function storePublicImage(StorePublicImageRequest $request)
    {
        $respone = resolve(StorePublicImageService::class)->setRequest($request)->handle();

        return response()->success($respone);
    }

    public function deletePath(DeletePathRequest $request)
    {
        resolve(DeletePathService::class)->setRequest($request)->handle();

        return response()->successWithoutData();
    }
}
