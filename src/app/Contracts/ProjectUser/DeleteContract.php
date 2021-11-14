<?php

namespace App\Contracts\ProjectUser;

use App\Models\ProjectUser;

interface DeleteContract
{
    function execute(ProjectUser $projectUser);
}