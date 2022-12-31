<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Answer;
use App\Models\Test;
use App\Models\Traits\Image;

class Question extends Model
{
    use HasFactory, Image;

    protected $fillable = [
        'content',
        'type',
        'sort_order',
        'test_id'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function test()
    {
        return $this->belongTo(Test::class);
    }
}
