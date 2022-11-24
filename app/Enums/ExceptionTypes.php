<?php

namespace App\Enums;

class ExceptionTypes
{
    const NOT_PERMISSION = 'errors.not_permission';
    const INVALID_LOGIN_CREDENTIALS = 'errors.invalid_login_credentials';
    const UNAUTHENTICATED = 'errors.unauthenticated';
    const LIMITED_SEND_RESET = 'errors.limited_send_reset';
    const NO_PERMISSION_ON_THIS_ADMIN = 'errors.no_permission_on_this_admin';
    const TOKEN_EXPIRED = 'passwords.token';
    const NOT_FOUND_IMAGE = 'not_found_image';
}
