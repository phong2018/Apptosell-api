<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Thread;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'sort_order',
        'status',
        'image'
    ];

    public function threads()
    {
        return $this->belongsToMany(Thread::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->generateUrl($this->image);
    }
}
