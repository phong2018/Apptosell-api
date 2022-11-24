<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            // phpcs:ignore
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapApiAdminsRoutes();
        $this->mapApiCooperatorsRoutes();
        $this->mapApiEmployeesRoutes();
        $this->mapApiUsersRoutes();
        $this->mapApiGuestsRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapApiAdminsRoutes()
    {
        Route::prefix('api/admins')
            ->middleware(['api'])
            ->name('admins.')
            ->namespace($this->namespace . '\Api\Admin')
            ->group(base_path('routes/api.admins.php'));
    }

    protected function mapApiCooperatorsRoutes()
    {
        Route::prefix('api/cooperators')
            ->middleware(['api'])
            ->name('cooperators.')
            ->namespace($this->namespace . '\Api\Cooperator')
            ->group(base_path('routes/api.cooperators.php'));
    }

    protected function mapApiEmployeesRoutes()
    {
        Route::prefix('api/employees')
            ->middleware(['api'])
            ->name('employees.')
            ->namespace($this->namespace . '\Api\Employee')
            ->group(base_path('routes/api.employees.php'));
    }

    protected function mapApiUsersRoutes()
    {
        Route::prefix('api/users')
            ->middleware(['api'])
            ->name('users.')
            ->namespace($this->namespace . '\Api\User')
            ->group(base_path('routes/api.users.php'));
    }

    protected function mapApiGuestsRoutes()
    {
        Route::prefix('api/guests')
            ->middleware('api')
            ->name('guests.')
            ->namespace($this->namespace . '\Api\Guest')
            ->group(base_path('routes/api.guests.php'));
    }
}
