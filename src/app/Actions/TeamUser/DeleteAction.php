<?php

namespace App\Actions\TeamUser;

use App\Contracts\TeamUser\DeleteContract;
use App\Models\TeamUser;
use Illuminate\Http\Response;

class DeleteAction implements DeleteContract
{
    public function execute(TeamUser $teamUser)
    {
        $teamUser->delete();
        
        return $this->buildResponse();
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Team user deleted successfully'
        ], Response::HTTP_OK);
    }
}