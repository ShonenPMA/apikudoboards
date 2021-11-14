<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\LogoutContract;
use Illuminate\Http\Response;

class LogoutAction implements LogoutContract
{
    public function execute()
    {
        
        return $this->deleteCurrentToken()
            ->buildResponse();       
    }

    private function deleteCurrentToken()
    {
        request()->user()->currentAccessToken()->delete();

        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'message' => 'User logout successfully',
        ], Response::HTTP_OK);
    }

}