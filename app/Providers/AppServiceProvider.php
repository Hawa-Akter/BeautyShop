<?php

namespace BeautyShop\Providers;

use BeautyShop\Categories;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $NavCategories=Categories::where('status',1)->with('NavigationSubCategory')->get();
        View::Share( 'NavCategories',$NavCategories  );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
