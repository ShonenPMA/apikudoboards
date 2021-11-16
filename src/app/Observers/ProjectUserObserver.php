<?php

namespace App\Observers;

use App\Models\Kudo;
use App\Models\ProjectUser;

class ProjectUserObserver
{
    /**
     * Handle the ProjectUser "created" event.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return void
     */
    public function created(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Handle the ProjectUser "updated" event.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return void
     */
    public function updated(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Handle the ProjectUser "deleted" event.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return void
     */
    public function deleted(ProjectUser $projectUser)
    {
        Kudo::where('user_sender_id', $projectUser->user_id)
            ->orWhere('user_receiver_id', $projectUser->user_id)
            ->delete();
    }

    /**
     * Handle the ProjectUser "restored" event.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return void
     */
    public function restored(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Handle the ProjectUser "force deleted" event.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return void
     */
    public function forceDeleted(ProjectUser $projectUser)
    {
        //
    }
}
