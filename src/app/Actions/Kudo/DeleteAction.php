<?php

namespace App\Actions\Kudo;

use App\Contracts\Kudo\DeleteContract;
use App\Models\Kudo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DeleteAction implements DeleteContract
{
    public function execute(Kudo $kudo)
    {
        $kudo->delete();
        
        return $this->buildResponse();
    }

    private function buildResponse() : JsonResponse
    {
        return response()->json([
            'message' => 'Kudo deleted successfully'
        ], Response::HTTP_OK);
    }
}