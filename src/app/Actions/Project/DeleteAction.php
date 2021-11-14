<?php

namespace App\Actions\Project;

use App\Contracts\Project\DeleteContract;
use App\Models\Project;
use Illuminate\Http\Response;

class DeleteAction implements DeleteContract
{
    public function execute(Project $project)
    {
        $project->delete();
        
        return $this->buildResponse();
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Project deleted successfully'
        ], Response::HTTP_OK);
    }
}