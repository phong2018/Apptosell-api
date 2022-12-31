<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Question;
use App\Models\Traits\Image;

class Answer extends Model
{
    use HasFactory, Image;

    protected $fillable = [
        'content',
        'point',
        'question_id'
    ];

    public function question()
    {
        return $this->belongTo(Question::class);
    }
}
