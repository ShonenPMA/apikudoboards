<?php

namespace App\Providers;

use App\Models\Kudo;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use App\Observers\KudoObserver;
use App\Observers\ProjectObserver;
use App\Observers\ProjectUserObserver;
use App\Observers\TeamObserver;
use App\Observers\TeamUserObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Project::observe(ProjectObserver::class);
        Team::observe(TeamObserver::class);
        ProjectUser::observe(ProjectUserObserver::class);
        TeamUser::observe(TeamUserObserver::class);
        Kudo::observe(KudoObserver::class);
    }
}
