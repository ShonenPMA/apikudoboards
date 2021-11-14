<?php

namespace App\Contracts\Project;

use App\Dtos\Project\UpdateDto;
use App\Models\Project;
use App\Models\User;

interface UpdateContract
{
    function execute(UpdateDto $dto, Project $project);
}