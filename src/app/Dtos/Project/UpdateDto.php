<?php

declare(strict_types=1);

namespace App\Dtos\Project;

use App\Http\Requests\Project\UpdateRequest;

class UpdateDto
{
    public function __construct(public string $name){ }
    
    public static function fromRequest(  UpdateRequest $request ): UpdateDto
    {
        return new UpdateDto(
            name: $request->get('name')
        );
    }
}