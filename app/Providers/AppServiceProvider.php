<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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

        //Sử dụng dữ liệu cho tất cả view
        view()->composer("*", function ($view) {
            //lấy danh mục
            $categories = DB::table('categories')->get();
            $view->with(compact('categories'));
        });
    }
}
