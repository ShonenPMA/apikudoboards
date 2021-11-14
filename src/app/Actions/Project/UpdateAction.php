<?php

namespace App\Actions\Project;

use App\Contracts\Project\UpdateContract;
use App\Dtos\Project\UpdateDto;
use App\Models\Project;
use Illuminate\Http\Response;

class UpdateAction implements UpdateContract
{
    private $project;
    public function execute(UpdateDto $dto, Project $project)
    {
        $this->project = $project;
        
        return $this->updateProject($dto, )
                ->buildResponse();
    }

    private function updateProject(UpdateDto $dto)
    {
        $this->project->name = $dto->name;
        $this->project->save();
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Project updated successfully'
        ], Response::HTTP_OK);
    }
}