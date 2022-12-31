<?php

namespace App\Http\Requests\Admin\Test;

use App\Http\Requests\BaseRequest;

class ShowTestRequest extends BaseRequest
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
        return $this->commonListRules();
    }
}
