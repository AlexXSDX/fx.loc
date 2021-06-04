<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\ForexFacade\I_ForexFacade;
use App\Services\ForexFacade\ForexFacade;

use App\Services\GetForex\I_GetForex;
use App\Services\GetForex\GetForexFromCb;

use App\Services\UpdateForex\I_UpdateForex;
use App\Services\UpdateForex\UpdateForex;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(I_ForexFacade::class, ForexFacade::class);
        $this->app->bind(I_GetForex::class, GetForexFromCb::class);
        $this->app->bind(I_UpdateForex::class, UpdateForex::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
