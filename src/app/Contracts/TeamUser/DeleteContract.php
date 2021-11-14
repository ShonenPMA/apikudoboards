<?php

namespace App\Contracts\TeamUser;

use App\Models\TeamUser;

interface DeleteContract
{
    function execute(TeamUser $teamUser);
}