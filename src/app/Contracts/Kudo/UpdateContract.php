<?php

namespace App\Contracts\Kudo;

use App\Dtos\Kudo\UpdateDto;
use App\Models\Kudo;
use App\Models\User;

interface UpdateContract
{
    function execute(UpdateDto $dto, Kudo $kudo);
}