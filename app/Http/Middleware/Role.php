<?php

namespace App\Http\Middleware;

use App\Enums\ExceptionTypes;
use App\Exceptions\BusinessException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class Role
{

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user() || (!Auth::user()->is_super_admin && !in_array($this->route->action['as'], Auth::user()->role->permissions))) {
            throw new BusinessException(ExceptionTypes::NOT_PERMISSION);
        }
        return $next($request);
    }
}
