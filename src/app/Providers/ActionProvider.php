<?php

namespace App\Providers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterAction;
use App\Contracts\Auth\LoginContract;
use App\Contracts\Auth\LogoutContract;
use App\Contracts\Auth\RegisterContract;
use Illuminate\Support\ServiceProvider;

class ActionProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Auth
        $this->app->bind(RegisterContract::class, RegisterAction::class);
        $this->app->bind(LoginContract::class, LoginAction::class);
        $this->app->bind(LogoutContract::class, LogoutAction::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
