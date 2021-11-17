<?php

namespace App\Observers;

use App\Events\KudoSent;
use App\Models\Kudo;

class KudoObserver
{
    /**
     * Handle the Kudo "created" event.
     *
     * @param  \App\Models\Kudo  $kudo
     * @return void
     */
    public function created(Kudo $kudo)
    {
        broadcast( new KudoSent($kudo->receiver, $kudo));
    }

    /**
     * Handle the Kudo "updated" event.
     *
     * @param  \App\Models\Kudo  $kudo
     * @return void
     */
    public function updated(Kudo $kudo)
    {
        //
    }

    /**
     * Handle the Kudo "deleted" event.
     *
     * @param  \App\Models\Kudo  $kudo
     * @return void
     */
    public function deleted(Kudo $kudo)
    {
        //
    }

    /**
     * Handle the Kudo "restored" event.
     *
     * @param  \App\Models\Kudo  $kudo
     * @return void
     */
    public function restored(Kudo $kudo)
    {
        //
    }

    /**
     * Handle the Kudo "force deleted" event.
     *
     * @param  \App\Models\Kudo  $kudo
     * @return void
     */
    public function forceDeleted(Kudo $kudo)
    {
        //
    }
}
