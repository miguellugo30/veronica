<?php

namespace Nimbus\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AgentesAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (false == Auth::guard('agentes')->check()) {
            return redirect('/agentes/login');
        }

        return $next($request);
    }
}
