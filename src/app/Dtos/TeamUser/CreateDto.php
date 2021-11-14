<?php

declare(strict_types=1);

namespace App\Dtos\TeamUser;

use App\Http\Requests\TeamUser\CreateRequest;

class CreateDto
{
    public function __construct(public int $user_id, public int $team_id){ }
    
    public static function fromRequest(  CreateRequest $request ): CreateDto
    {
        return new CreateDto(
            user_id: $request->get('user_id'),
            team_id: $request->get('team_id')
        );
    }
}