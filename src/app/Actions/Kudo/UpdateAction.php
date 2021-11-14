<?php

namespace App\Actions\Kudo;

use App\Contracts\Kudo\UpdateContract;
use App\Dtos\Kudo\UpdateDto;
use App\Models\Kudo;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateAction implements UpdateContract
{
    private $kudo;
    public function execute(UpdateDto $dto, Kudo $kudo) : JsonResponse
    {
        $this->kudo = $kudo;
        return $this->updateKudo($dto)
                ->buildResponse();
    }

    private function updateKudo(UpdateDto $dto)
    {
        $this->kudo->description = $dto->description;

        $this->kudo->save();
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Kudo updated successfully'
        ], Response::HTTP_OK);
    }
}