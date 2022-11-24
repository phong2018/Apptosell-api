<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** @SuppressWarnings(PHPMD.NumberOfChildren) */
class BaseRequest extends FormRequest
{
    const MIN_LENGTH_EMAIL = 3;
    const MAX_LENGTH_EMAIL = 250;

    const MIN_LENGTH_PASSWORD = 8;
    const MAX_LENGTH_PASSWORD = 256;

    const MAX_LENGTH_NAME_ACCOUNT = 256;

    const INT_32_MIN = 1;
    const LIMIT_DEFAULT_MAX = 100;
    const ORDER_DEFAULT_LENGTH = 100;
    const WITH_DEFAULT_LENGTH = 500;

    const MAX_SIZE_IMAGE = 5130;
    const PATH_IMAGE = '/.(?:png|jpe?g)$/i';

    /**
     * Common list rules
     *
     * @return array
     */
    public function commonListRules()
    {
        return [
            'page' => [
                'bail',
                'sometimes',
                'integer',
            ],
            'per_page' => [
                'bail',
                'sometimes',
                'integer',
                'min:' . self::INT_32_MIN,
                'max:' . static::LIMIT_DEFAULT_MAX
            ],
            'order' => [
                'bail',
                'sometimes',
                'string',
                'max:' . self::ORDER_DEFAULT_LENGTH
            ],
            'with' => [
                'bail',
                'sometimes',
                'string',
                'max:' . self::WITH_DEFAULT_LENGTH
            ]
        ];
    }
}
