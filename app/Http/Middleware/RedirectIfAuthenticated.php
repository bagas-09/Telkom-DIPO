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
     * @param \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param string|null ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $account = Auth::guard("account")->user();

        switch ($guard) {
            case "account":
                if ($account) {
                    if($account->role == 1){
                        return redirect()->route('admin.dashboard.index');
                    }else if($account->role == 2){
                        return redirect()->route('admin.dashboard.role');
                    }else if($account->role == 3){
                        return redirect()->route('admin.dashboard.role');
                    }else if($account->role == 4){
                        return redirect()->route('admin.dashboard.role');
                    }else if($account->role == 5){
                        return redirect()->route('admin.dashboard.role');
                    }else if($account->role == 6){
                        return redirect()->route('admin.dashboard.role');
                    }
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }

        return $next($request);
    }
}
