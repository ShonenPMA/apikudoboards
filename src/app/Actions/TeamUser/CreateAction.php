<?php

namespace App\Actions\TeamUser;

use App\Contracts\TeamUser\CreateContract;
use App\Dtos\TeamUser\CreateDto;
use App\Http\Resources\TeamUserResource;
use App\Models\TeamUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateAction implements CreateContract
{
    private $teamUser;
    public function execute(CreateDto $dto ) : JsonResponse
    {
        return $this->registerMemberInTeam($dto)
            ->buildResponse();
    }

    private function registerMemberInTeam(CreateDto $dto)
    {
        $this->teamUser = new TeamUser();
        $this->teamUser->user_id = $dto->user_id;
        $this->teamUser->team_id = $dto->team_id;

        $this->teamUser->save();
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Member registered successfully',
            'data' => new TeamUserResource($this->teamUser)
        ], Response::HTTP_OK);
    }
}