<?php

namespace App\Actions\Kudo;

use App\Contracts\Kudo\CreateContract;
use App\Dtos\Kudo\CreateDto;
use App\Models\Kudo;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateAction implements CreateContract
{
    private $kudo;
    public function execute(CreateDto $dto, User $user) : JsonResponse
    {
        return $this->sendKudo($dto, $user->id)
                ->buildResponse();
    }

    private function sendKudo(CreateDto $dto, int $sender_id)
    {
        $this->kudo = new Kudo();
        $this->kudo->description = $dto->description;
        $this->kudo->kudoboard_id = $dto->kudoboard_id;
        $this->kudo->user_receiver_id = $dto->user_receiver_id;
        $this->kudo->user_sender_id = $sender_id;

        $this->kudo->save();
        
        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'Kudo sended successfully'
        ], Response::HTTP_OK);
    }
}