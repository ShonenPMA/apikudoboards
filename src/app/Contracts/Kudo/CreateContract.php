<?php

namespace App\Contracts\Kudo;

use App\Dtos\Kudo\CreateDto;
use App\Models\User;

interface CreateContract
{
    function execute(CreateDto $dto, User $user);
}