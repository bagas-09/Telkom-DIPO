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
                    if($account->role == 'Commerce'){
                        return redirect()->route('admin.dashboard.index');
                    }else if($account->role == 'Maintenance'){
                        return redirect()->route('admin.dashboard.jenisOrder');
                    }else if($account->role == 'Konstruksi'){
                        return redirect()->route('admin.dashboard.index');
                    }else if($account->role == 'GM'){
                        return redirect()->route('admin.dashboard.index');
                    }else if($account->role == 'Admin'){
                        return redirect()->route('admin.dashboard.index');
                    }else if($account->role == 'Procurement'){
                        return redirect()->route('admin.dashboard.index');
                    }
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/login');
                }
                break;
        }

        return $next($request);
    }
}
