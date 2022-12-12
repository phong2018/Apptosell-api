<?php

namespace App\Models;

use App\Models\Traits\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use Image, HasFactory;

    protected $fillable = [
        'name',
        'content',
        'status'
    ];
}
