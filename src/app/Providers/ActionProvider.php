<?php

namespace App\Providers;

use App\Actions\Auth\EditProfileAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Project\CreateAction;
use App\Contracts\Auth\EditProfileContract;
use App\Contracts\Auth\LoginContract;
use App\Contracts\Auth\LogoutContract;
use App\Contracts\Auth\RegisterContract;
use App\Contracts\Project\CreateContract;
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
        $this->app->bind(EditProfileContract::class, EditProfileAction::class);

        //Project
        $this->app->bind(CreateContract::class, CreateAction::class);
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
