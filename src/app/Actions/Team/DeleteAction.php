<?php

namespace App\Actions\Team;

use App\Contracts\Team\DeleteContract;
use App\Models\Team;
use Illuminate\Http\Response;

class DeleteAction implements DeleteContract
{
    public function execute(Team $team)
    {
        $team->delete();
        
        return $this->buildResponse();
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Team deleted successfully'
        ], Response::HTTP_OK);
    }
}