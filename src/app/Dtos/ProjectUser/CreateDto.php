<?php

declare(strict_types=1);

namespace App\Dtos\ProjectUser;

use App\Http\Requests\ProjectUser\CreateRequest;

class CreateDto
{
    public function __construct(public int $user_id, public int $project_id){ }
    
    public static function fromRequest(  CreateRequest $request ): CreateDto
    {
        return new CreateDto(
            user_id: $request->get('user_id'),
            project_id: $request->get('project_id')
        );
    }
}