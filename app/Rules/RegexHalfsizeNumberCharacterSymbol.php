<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class RegexHalfsizeNumberCharacterSymbol implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     * @SuppressWarnings("unused")
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!preg_match("/^([a-zA-Z0-9_ @!\"#$%&'()*+,-.\/:;<=>?[\]^_`{|}~\"])+$/", $value)) {
            $fail(trans('validation.regex_halfsize_number_character_symbol'));  // phpcs:ignore
        }
    }
}
