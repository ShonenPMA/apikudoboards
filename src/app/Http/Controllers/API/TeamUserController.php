<?php

namespace App\Http\Controllers\API;

use App\Contracts\TeamUser\CreateContract;
use App\Dtos\TeamUser\CreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamUser\CreateRequest;
use App\Models\TeamUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Team User
 * @authenticated
 */
class TeamUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created team user.
     * @responseFile responses/teamUser/store.json
     * @param  \App\Http\Requests\TeamUser\CreateRequest  $request
     * @param \App\Contracts\TeamUser\CreateContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $request, CreateContract $contract) : JsonResponse
    {
        return $contract->execute(CreateDto::fromRequest($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamUser  $teamUser
     * @return \Illuminate\Http\Response
     */
    // public function destroy(TeamUser $teamUser)
    // {
    //     //
    // }
}
