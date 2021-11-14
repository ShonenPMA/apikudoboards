<?php

namespace App\Actions\ProjectUser;

use App\Contracts\ProjectUser\DeleteContract;
use App\Models\ProjectUser;
use Illuminate\Http\Response;

class DeleteAction implements DeleteContract
{
    public function execute(ProjectUser $projectUser)
    {
        $projectUser->delete();
        
        return $this->buildResponse();
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Project user deleted successfully'
        ], Response::HTTP_OK);
    }
}