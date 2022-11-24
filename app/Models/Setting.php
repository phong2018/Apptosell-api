<?php

namespace App\Models;

use App\Models\Traits\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use SoftDeletes, Image, HasFactory;

    protected $fillable = [
        'name',
        'note',
        'image',
        'is_use'
    ];

    public function getImageUrlAttribute()
    {
        return $this->generateUrl($this->image);
    }
}
