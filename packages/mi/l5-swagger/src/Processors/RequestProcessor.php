<?php

namespace Mi\L5Swagger\Processors;

use Mi\L5Swagger\Schemas\RequestBody;

class RequestProcessor extends AbstractProcessor
{
    public static function detectRequestAccept($rules)
    {
        foreach ($rules as $key => $value) {
            if (!is_string($value)) {
                unset($rules[$key]);
            }
        }

        return preg_match(self::REGEX_FILE, implode(';;;', $rules))
            ? RequestBody::ACCEPT_FORM_DATA
            : RequestBody::ACCEPT_JSON;
    }
}
