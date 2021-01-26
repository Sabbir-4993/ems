<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\permissionTrait;

class HasPermission
{
    use permissionTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->hasPermission();
        return $next($request);

    }

}

