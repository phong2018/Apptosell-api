<?php

namespace App\Http\Requests\Admin\Question;

use App\Enums\QuestionType;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateQuestionRequest extends BaseRequest
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
                'integer',
                Rule::in(QuestionType::getQuestionType())
            ],
            'point' => [
                'required'
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
