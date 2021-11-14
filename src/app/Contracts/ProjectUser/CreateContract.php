<?php

namespace App\Contracts\ProjectUser;

use App\Dtos\ProjectUser\CreateDto;

interface CreateContract
{
    function execute(CreateDto $dto);
}