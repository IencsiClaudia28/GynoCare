<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\StripeService;
use App\Interfaces\PaymentServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentServiceInterface::class, StripeService::class);
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
