<?php

namespace App\Contracts\Team;

use App\Models\Team;

interface DeleteContract
{
    function execute(Team $team);
}