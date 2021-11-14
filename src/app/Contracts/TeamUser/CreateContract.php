<?php

namespace App\Contracts\TeamUser;

use App\Dtos\TeamUser\CreateDto;

interface CreateContract
{
    function execute(CreateDto $dto);
}