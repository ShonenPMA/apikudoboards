<?php

namespace App\Http\Controllers\API;

use App\Contracts\TeamUser\CreateContract;
use App\Contracts\TeamUser\DeleteContract;
use App\Dtos\TeamUser\CreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamUser\CreateRequest;
use App\Http\Resources\TeamUserResource;
use App\Models\Team;
use App\Models\TeamUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Team User
 * @authenticated
 */
class TeamUserController extends Controller
{
    /**
     * Display a listing of team users from a Team.
     * @responseFile responses/teamUser/indexFromTeam.json
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function indexFromTeam(Team $team) : AnonymousResourceCollection
    {
        return TeamUserResource::collection( 
            TeamUser::select(['team_users.*', 'users.name as username'])
                ->join('users', 'team_users.user_id', '=', 'users.id')
                ->where('team_users.team_id', $team->id)
                ->has('user')
                ->orderBy('users.name', 'ASC')
                ->filter(request()->get('filter', ''))
                ->paginate(request()->get('per_page', 15)) 
        );
    }

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
     * Remove the specified team user.
     * @responseFile responses/teamUser/destroy.json
     * @param  \App\Models\TeamUser  $teamUser
     * @param \App\Contracts\Team\DeleteContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TeamUser $teamUser, DeleteContract $contract) : JsonResponse
    {
        return $contract->execute($teamUser);
    }
}
