<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\EditProfileContract;
use App\Dtos\Auth\EditProfileDto;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EditProfileAction implements EditProfileContract
{
    private $user;
    private $logout = false;
    public function execute(EditProfileDto $dto) : JsonResponse
    {
        
        return  $this->updateUser($dto)
                        ->updatePassword($dto->password)
                        ->buildResponse();
    }

    private function updateUser(EditProfileDto $dto)
    {
        $this->user = request()->user();
        $this->user->name = $dto->name;
        $this->user->email = $dto->email;
        $this->user->birth_date = $dto->birth_date;
        
        $this->user->save();

        return $this;
    }

    private function updatePassword($password = '')
    {
        if($password != '')
        {
            $this->user->password = bcrypt($password);
            $this->user->save();
            
            $this->logoutUser();
        }
        
        return $this;
    }

    private function logoutUser()
    {
        $this->logout = true;
        request()->user()->currentAccessToken()->delete();
    }

    private function buildResponse()
    {
        return response()->json([
            'data' => [
                'logout' => $this->logout
            ],
            'message' => 'User profile updated successfully'
        ], Response::HTTP_OK);
    }
}