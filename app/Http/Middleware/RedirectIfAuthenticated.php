<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case "super admin":
                if (Auth::guard("super admin")->check()) {
                    return redirect()->route('admin.dashboard.index');
                }
                break;
                // case "general manager":
                //     if (Auth::guard("general manager")->check()) {
                //         return redirect()->route('gm.home');
                //     }
                //     break;
                // case "commerce":
                //     if (Auth::guard("commerce")->check()) {
                //         return redirect()->route('commerce.home'); //TODO
                //     }
                //     break;
                // case "finance":
                //     if (Auth::guard("finance")->check()) {
                //         return redirect()->route('finance.home');
                //     }
                //     break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }

        return $next($request);
    }
}
