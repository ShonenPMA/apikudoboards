<?php

namespace App\Actions\ProjectUser;

use App\Contracts\ProjectUser\CreateContract;
use App\Dtos\ProjectUser\CreateDto;
use App\Models\ProjectUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateAction implements CreateContract
{
    private $projectUser;
    public function execute(CreateDto $dto ) : JsonResponse
    {
        return $this->registerMemberInProject($dto)
            ->buildResponse();
    }

    private function registerMemberInProject(CreateDto $dto)
    {
        $this->projectUser = new ProjectUser();
        $this->projectUser->user_id = $dto->user_id;
        $this->projectUser->project_id = $dto->project_id;

        $this->projectUser->save();
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Member registered successfully'
        ], Response::HTTP_OK);
    }
}