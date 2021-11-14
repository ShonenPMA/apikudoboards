<?php

namespace App\Contracts\Auth;

use App\Dtos\Auth\RegisterDto;

interface RegisterContract
{
    function execute(RegisterDto $dto);
}