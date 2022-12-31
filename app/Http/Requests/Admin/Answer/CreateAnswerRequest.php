<?php

namespace App\Http\Requests\Admin\Answer;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateAnswerRequest extends BaseRequest
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
                'required',
                'string'
            ],
            'point' => [
                'integer'
            ],
            'question_id' => [
                'required',
                Rule::exists('questions', 'id')
            ]
        ];
    }
}
