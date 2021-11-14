<?php

namespace App\Http\Controllers\API;

use App\Contracts\Team\CreateContract;
use App\Contracts\Team\DeleteContract;
use App\Contracts\Team\UpdateContract;
use App\Dtos\Team\CreateDto;
use App\Dtos\Team\UpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Team
 * @authenticated
 */
class TeamController extends Controller
{
    /**
     * Display a listing of teams from authenticated user.
     * @responseFile responses/team/indexFromAuthUser.json
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function indexFromAuthUser() : AnonymousResourceCollection
    {
        return TeamResource::collection( 
            Team::where('user_id', request()->user()->id)
                ->filter(request()->get('filter', ''))
                ->orderBy('name', 'ASC')
                ->paginate(request()->get('per_page', 15)) 
        );
    }

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
     * Update the specified team.
     * @responseFile responses/team/update.json
     * @param  \App\Http\Requests\Team\UpdateRequest  $request
     * @param  \App\Models\Team  $team
     * @param  \App\Contracts\Team\UpdateContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Team $team, UpdateContract $contract) : JsonResponse
    {
        return $contract->execute(UpdateDto::fromRequest($request), $team);
    }

    /**
     * Remove the specified team.
     *
     * @param  \App\Models\Team  $team
     * @param \App\Contracts\Team\DeleteContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Team $team, DeleteContract $contract) : JsonResponse
    {
        return $contract->execute($team);
    }
}
