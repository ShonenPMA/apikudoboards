<?php

namespace App\Actions\Project;

use App\Contracts\Project\CreateContract;
use App\Dtos\Project\CreateDto;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Response;

class CreateAction implements CreateContract
{
    private $project;
    public function execute(CreateDto $dto, User $user)
    {
        return $this->createProject($dto, $user)
                ->buildResponse();
    }

    private function createProject(CreateDto $dto, User $user)
    {
        $this->project = new Project();
        $this->project->name = $dto->name;
        $this->project->user_id = $user->id;
        $this->project->save();
        
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Project created successfully'
        ], Response::HTTP_OK);
    }
}