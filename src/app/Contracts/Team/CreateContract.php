<?php

namespace App\Contracts\Team;

use App\Dtos\Team\CreateDto;
use App\Models\User;

interface CreateContract
{
    function execute(CreateDto $dto, User $user);
}