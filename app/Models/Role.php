<?php

namespace App\Models;

use App\Models\Traits\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use SoftDeletes, Image, HasFactory;

    protected $fillable = [
        'name',
        'note',
        'route',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'json'
    ];
}
