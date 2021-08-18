<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;

class AdminMiddleware
{
    use ApiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->status != 'admin'){
            $mess = 'UnAuthencatic';
            $err = 'UnAuthencatic';
            $statusCode = 401;
            // dd(1);
            return $this->responseError($mess,$err,$statusCode);
        }
        return $next($request);
    }
}
