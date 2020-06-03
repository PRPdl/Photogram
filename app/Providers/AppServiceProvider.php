<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Channel;
use App\Http\Controllers\View\Composers\ChannelsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(request()->has('credit')) {
            $this->app->singleton(PaymentGatewayContract::class, function ($app) {
                return new CreditPaymentGateway('USD');
            });
        }elseif (request()->has('bank')){
            $this->app->singleton(PaymentGatewayContract::class, function ($app){
                return new BankPaymentGateway('USD');
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Option 1 - For all Views - View Composer
//        View::share('channels', Channel::orderBy('name')->get());

        // Option-2 Granular View with wildcards
//        View::composer(['post.*', 'channel.index'], function ($view){
//           $view->with('channels', Channel::orderBy('name', 'desc')->get());
//        });
        //Option-3 Dedicated Class
        View::composer('partials.channels.*', ChannelsComposer::class);
    }
}
