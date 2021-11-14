<?php

namespace App\Actions\Team;

use App\Contracts\Team\CreateContract;
use App\Dtos\Team\CreateDto;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Response;

class CreateAction implements CreateContract
{
    private $team;
    public function execute(CreateDto $dto, User $user)
    {
        return $this->createTeam($dto, $user)
                ->buildResponse();
    }

    private function createTeam(CreateDto $dto, User $user)
    {
        $this->team = new Team();
        $this->team->name = $dto->name;
        $this->team->user_id = $user->id;
        $this->team->save();
        
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Team created successfully'
        ], Response::HTTP_OK);
    }
}