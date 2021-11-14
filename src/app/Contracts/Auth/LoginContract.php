<?php

namespace App\Contracts\Auth;

use App\Dtos\Auth\LoginDto;

interface LoginContract
{
    function execute(LoginDto $dto);
}