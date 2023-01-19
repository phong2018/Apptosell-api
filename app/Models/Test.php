<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Question;
use App\Models\Traits\Image;

class Test extends Model
{
    use HasFactory, Image;

    protected $fillable = [
        'name',
        'content',
        'result',
        'image',
        'tag',
        'sort_order',
        'time_test',
        'status'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->generateUrl($this->image, true);
    }
}
