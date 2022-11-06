<?php
/**
 * src/Builders/EncryptionEloquentBuilder.php.
 *
 */
namespace Mi\L9DBEncrypt\Builders;
use Illuminate\Database\Eloquent\Builder;

class EncryptionEloquentBuilder extends Builder
{
    public function whereEncrypted($param1, $param2, $param3 = null)
    {
      $filter            = new \stdClass();
      $filter->field     = $param1;
      $filter->operation = isset($param3) ? $param2 : '=';
      $filter->value     = isset($param3) ? $param3 : $param2;

      $salt = substr(hash('sha256', env('APP_KEY')), 0, 16);

      return self::whereRaw("convert_from(decrypt(decode({$filter->field},'base64')::bytea , '{$salt}', 'aes-cbc/pad:pkcs'), 'UTF-8') {$filter->operation} ? ", [$filter->value]);
    }

    public function orWhereEncrypted($param1, $param2, $param3 = null)
    {
      $filter            = new \stdClass();
      $filter->field     = $param1;
      $filter->operation = isset($param3) ? $param2 : '=';
      $filter->value     = isset($param3) ? $param3 : $param2;

      $salt = substr(hash('sha256', env('APP_KEY')), 0, 16);
      return self::orWhereRaw("convert_from(decrypt(decode({$filter->field},'base64')::bytea , '{$salt}', 'aes-cbc/pad:pkcs'), 'UTF-8') {$filter->operation} ? ", [$filter->value]);
    }
}