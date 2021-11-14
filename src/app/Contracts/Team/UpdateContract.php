<?php

namespace App\Contracts\Team;

use App\Dtos\Team\UpdateDto;
use App\Models\Team;

interface UpdateContract
{
    function execute(UpdateDto $dto, Team $team);
}