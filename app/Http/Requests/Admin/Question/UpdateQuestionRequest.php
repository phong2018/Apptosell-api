<?php

namespace App\Http\Requests\Admin\Question;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateQuestionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => [
                'nullable',
                'string'
            ],
            'type' => [
                'nullable',
                'integer'
            ],
            'sort_order' => [
                'nullable',
                'integer'
            ],
            'test_id' => [
                'required',
                Rule::exists('tests', 'id')
            ]
        ];
    }
}
