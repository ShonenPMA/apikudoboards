<?php

namespace App\Contexts;

use App\Strategies\KudoboardTypes\BirthdayType;
use App\Strategies\KudoboardTypes\ProjectType;
use App\Strategies\KudoboardTypes\TeamType;
use App\Strategies\KudoboardTypes\UserType;

final class KudoboardTypesContext
{
    const TYPE = [
        'team' => TeamType::class,
        'project' => ProjectType::class,
        'birthday' => BirthdayType::class,
        'user' => UserType::class,
    ];
}