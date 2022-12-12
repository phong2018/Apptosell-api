<?php

namespace App\Services\Post;

use App\Common\Image;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\DB;
use Mi\L5Core\Services\BaseService;

class CreatePostService extends BaseService
{
    protected $collectsData = true;

    public function __construct(
        PostRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $data = $this->data->all();
        if (isset($data['image'])) {
            $data['image'] = Image::generateStorageImage($data['image']);
        }

        return DB::transaction(function () use ($data) {
            $post = $this->repository->create($data);
            if ($this->data->get('threads')) {
                $post->threads()->sync($this->data->get('threads'));
            }
            return $post;
        });
    }
}
