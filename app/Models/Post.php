<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Thread;
use App\Models\Traits\Image;

class Post extends Model
{
    use HasFactory, Image;

    protected $fillable = [
        'name',
        'description',
        'content',
        'sort_order',
        'status',
        'image',
        'publish_date'
    ];

    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'thread_posts', 'post_id', 'thread_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->generateUrl($this->image, true);
    }
}
