<?php

namespace App\Providers;

use App\Actions\Auth\EditProfileAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Project\CreateAction;
use App\Actions\Project\DeleteAction;
use App\Actions\Project\UpdateAction;
use App\Actions\Team\CreateAction as TeamCreateAction;
use App\Contracts\Auth\EditProfileContract;
use App\Contracts\Auth\LoginContract;
use App\Contracts\Auth\LogoutContract;
use App\Contracts\Auth\RegisterContract;
use App\Contracts\Project\CreateContract;
use App\Contracts\Project\DeleteContract;
use App\Contracts\Project\UpdateContract;
use App\Contracts\Team\CreateContract as TeamCreateContract;
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
        $this->app->bind(UpdateContract::class, UpdateAction::class);
        $this->app->bind(DeleteContract::class, DeleteAction::class);

        // Team
        $this->app->bind(TeamCreateContract::class, TeamCreateAction::class);
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
