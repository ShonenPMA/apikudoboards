<?php

namespace App\Contracts\Project;

use App\Models\Project;

interface DeleteContract
{
    function execute(Project $project);
}