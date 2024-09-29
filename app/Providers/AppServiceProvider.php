<?php

namespace App\Providers;

use App\Models\LaporanCommerce;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\LaporanProcurement;
use App\Models\LaporanKonstruksi;
use App\Models\LaporanMaintenance;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view){
            $countc = LaporanCommerce::where('draft', 1)->count();
            $view->with('countc', $countc);
            
            
        });
        View::composer('**', function ($viewp){
            $countp = LaporanProcurement::where('draft', 1)->count();
            $viewp->with('countp', $countp);
            
        });
        View::composer('*', function ($view){
            $countk = LaporanKonstruksi::where('draft', 1)->count();
            $view->with('countk', $countk);
            
            
        });
        View::composer('*', function ($view){
            $countm = LaporanMaintenance::where('draft', 1)->count();
            $view->with('countm', $countm);
            
            
        });
        
        
    }
}
