<?php

namespace App\Enums;

class QuestionType
{
    const SINGLE_CHOICE = 1;
    const MULTIPLE_CHOICE = 2;

    public static function getQuestionType() {
        return [
            self::SINGLE_CHOICE,
            self::MULTIPLE_CHOICE
        ];
    }
}
