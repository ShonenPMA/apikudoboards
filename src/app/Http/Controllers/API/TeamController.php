<?php

namespace App\Http\Controllers\API;

use App\Contracts\Team\CreateContract;
use App\Dtos\Team\CreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateRequest;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Team
 * @authenticated
 */
class TeamController extends Controller
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
     * Store a new team.
     * @responseFile responses/team/store.json
     * @param  \App\Http\Requests\Team\CreateRequest  $request
     * @param  \App\Contracts\Team\CreateContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $request, CreateContract $contract) : JsonResponse
    {
        return $contract->execute(CreateDto::fromRequest($request), request()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Team $team)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Team $team)
    // {
    //     //
    // }
}
