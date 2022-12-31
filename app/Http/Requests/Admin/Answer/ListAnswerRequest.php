<?php

namespace App\Http\Requests\Admin\Answer;

use App\Http\Requests\BaseRequest;

class ListAnswerRequest extends BaseRequest
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
        return array_merge($this->commonListRules(), [
            'id' => [
                'nullable',
                'integer'
            ],
            'question_id' => [
                'nullable',
                'integer'
            ]
        ]);
    }
}
