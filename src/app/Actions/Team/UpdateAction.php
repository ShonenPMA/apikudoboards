<?php

namespace App\Actions\Team;

use App\Contracts\Team\UpdateContract;
use App\Dtos\Team\UpdateDto;
use App\Models\Team;
use Illuminate\Http\Response;

class UpdateAction implements UpdateContract
{
    private $team;
    public function execute(UpdateDto $dto, Team $team)
    {
        $this->team = $team;
        
        return $this->updateTeam($dto, )
                ->buildResponse();
    }

    private function updateTeam(UpdateDto $dto)
    {
        $this->team->name = $dto->name;
        $this->team->save();
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Team updated successfully'
        ], Response::HTTP_OK);
    }
}