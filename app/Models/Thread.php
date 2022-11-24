<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Post;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'sort_order',
        'status'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
