<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mi\L5Swagger\SwaggerServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.env') != 'production') {
            $this->app->register(SwaggerServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResponseMacros();
        if (in_array($this->app->environment(), ['production', 'development'])) {
            \URL::forceScheme('https');
        }
    }

    private function registerResponseMacros()
    {
        /**
         * Return a new JSON response with status code 200.
         *
         * @package \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
         * @param   array  $data
         * @return  \Illuminate\Http\JsonResponse
         */
        Response::macro('success', function ($data) {
            return response()->json($data, 200);
        });

        Response::macro('created', function ($data) {
            return response()->json($data, 201);
        });

        Response::macro('successWithoutData', function () {
            return response()->json([ 'success' => true ], 200);
        });

        Response::macro('notModified', function ($data) {
            return response()->json($data, 304);
        });

        Response::macro('error', function ($data, $statusCode = 400) {
            return response()->json($data, $statusCode);
        });

        Response::macro('notFound', function ($data) {
            return response()->json($data, 404);
        });

        Response::macro('invalid', function ($data) {
            return response()->json($data, 422);
        });

        Response::macro('xml', function ($data) {
            return response($data)->header('Content-Type', 'application/xml');
        });
    }
}
