<?php

declare(strict_types=1);

namespace App\Dtos\Project;

use App\Http\Requests\Project\CreateRequest;

class CreateDto
{
    public function __construct(public string $name){ }
    
    public static function fromRequest(  CreateRequest $request ): CreateDto
    {
        return new CreateDto(
            name: $request->get('name')
        );
    }
}