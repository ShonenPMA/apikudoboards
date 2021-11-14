<?php

namespace App\Contracts\Kudo;

use App\Models\Kudo;

interface DeleteContract
{
    function execute(Kudo $kudo);
}