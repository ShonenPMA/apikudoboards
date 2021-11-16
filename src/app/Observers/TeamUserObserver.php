<?php

namespace App\Observers;

use App\Models\Kudo;
use App\Models\TeamUser;

class TeamUserObserver
{
    /**
     * Handle the TeamUser "created" event.
     *
     * @param  \App\Models\TeamUser  $teamUser
     * @return void
     */
    public function created(TeamUser $teamUser)
    {
        //
    }

    /**
     * Handle the TeamUser "updated" event.
     *
     * @param  \App\Models\TeamUser  $teamUser
     * @return void
     */
    public function updated(TeamUser $teamUser)
    {
        //
    }

    /**
     * Handle the TeamUser "deleted" event.
     *
     * @param  \App\Models\TeamUser  $teamUser
     * @return void
     */
    public function deleted(TeamUser $teamUser)
    {
        Kudo::where('user_sender_id', $teamUser->user_id)
            ->orWhere('user_receiver_id', $teamUser->user_id)
            ->delete();
    }

    /**
     * Handle the TeamUser "restored" event.
     *
     * @param  \App\Models\TeamUser  $teamUser
     * @return void
     */
    public function restored(TeamUser $teamUser)
    {
        //
    }

    /**
     * Handle the TeamUser "force deleted" event.
     *
     * @param  \App\Models\TeamUser  $teamUser
     * @return void
     */
    public function forceDeleted(TeamUser $teamUser)
    {
        //
    }
}
