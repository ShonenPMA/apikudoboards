<?php

namespace App\Contracts\Project;

use App\Dtos\Project\CreateDto;
use App\Models\User;

interface CreateContract
{
    function execute(CreateDto $dto, User $user);
}