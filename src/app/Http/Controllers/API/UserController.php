<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group User
 * @authenticated
 */
class UserController extends Controller
{
    /**
     * List of users except the current auth user
     * @responseFile responses/user/indexExceptAuth.json
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function indexExceptAuth() : AnonymousResourceCollection
    {
        return UserResource::collection(
            User::where('id', '<>', request()->user()->id)
            ->orderBy('name', 'ASC')
            ->get()
        );
    }
}
