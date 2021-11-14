<?php

namespace App\Contracts\Auth;

use App\Dtos\Auth\EditProfileDto;

interface EditProfileContract
{
    function execute(EditProfileDto $dto);
}