<?php
/**
 * src/Providers/EncryptServiceProvider.php.
 *
 */
namespace Mi\L9DBEncrypt\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

use Mi\L9DBEncrypt\Console\Commands\EncryptModel;
use Mi\L9DBEncrypt\Console\Commands\DecryptModel;

class DBEncryptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * This method is called after all other service providers have
     * been registered, meaning you have access to all other services
     * that have been registered by the framework.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootValidators();

        if ($this->app->runningInConsole()) {
            $this->commands([
                EncryptModel::class,
                DecryptModel::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }


    private function bootValidators()
    {

        Validator::extend('unique_encrypted', function ($attribute, $value, $parameters, $validator) {

            // Initialize
            $salt = substr(hash('sha256', env('APP_KEY')), 0, 16);

            $withFilter = count($parameters) > 3 ? true : false;

            $ignore_id = isset($parameters[2]) ? $parameters[2] : '';

            // Check using normal checker
            $data = DB::table($parameters[0])->whereRaw("convert_from(decrypt(decode({$parameters[1]},'base64')::bytea , '{$salt}', 'aes-cbc/pad:pkcs') , 'UTF-8') = '{$value}' ");
            $data = $ignore_id != '' ? $data->where('id','!=',$ignore_id) : $data;

            if ($withFilter) {
                $data->where($parameters[3], $parameters[4]);
            }

            if($data->first()){
                return false;
            }

            return true;
        });

        Validator::extend('exists_encrypted', function ($attribute, $value, $parameters, $validator) {

            // Initialize
            $salt = substr(hash('sha256', env('APP_KEY')), 0, 16);

            $withFilter = count($parameters) > 3 ? true : false;
            if(!$withFilter){
                $ignore_id = isset($parameters[2]) ? $parameters[2] : '';
            }else{
                $ignore_id = isset($parameters[4]) ? $parameters[4] : '';
            }
            
            // Check using normal checker
            $data = DB::table($parameters[0])->whereRaw("convert_from(decrypt(decode({$parameters[1]},'base64')::bytea , '{$salt}', 'aes-cbc/pad:pkcs') , 'UTF-8') = '{$value}' ");
            $data = $ignore_id != '' ? $data->where('id','!=',$ignore_id) : $data;

            if ($withFilter) {
                $data->where($parameters[2], $parameters[3]);
            }

            if ($data->first()) {
                return true;
            }
            
            return false;
        });
    }
}