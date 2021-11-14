<?php

namespace App\Http\Controllers\API;

use App\Contracts\ProjectUser\CreateContract;
use App\Contracts\ProjectUser\DeleteContract;
use App\Dtos\ProjectUser\CreateDto;
use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectUser\CreateRequest;
use App\Http\Resources\ProjectUserResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Project User
 * @authenticated
 */
class ProjectUserController extends Controller
{
    /**
     * Display a listing of project users from a Project.
     * @responseFile responses/projectUser/indexFromProject.json
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function indexFromProject(Project $project) : AnonymousResourceCollection
    {
        return ProjectUserResource::collection( 
            ProjectUser::select(['project_users.*', 'users.name as username'])
                ->join('users', 'project_users.user_id', '=', 'users.id')
                ->where('project_users.project_id', $project->id)
                ->has('user')
                ->orderBy('users.name', 'ASC')
                ->filter(request()->get('filter', ''))
                ->paginate(request()->get('per_page', 15)) 
        );
    }

    /**
     * Store a newly created project user.
     * @responseFile responses/projectUser/store.json
     * @param  \App\Http\Requests\ProjectUser\CreateRequest  $request
     * @param \App\Contracts\ProjectUser\CreateContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $request, CreateContract $contract) : JsonResponse
    {
        return $contract->execute(CreateDto::fromRequest($request));
    }

    /**
     * Remove the specified project user.
     * @responseFile responses/projectUser/destroy.json
     * @param  \App\Models\ProjectUser  $projectUser
     * @param \App\Contracts\Project\DeleteContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProjectUser $projectUser, DeleteContract $contract) : JsonResponse
    {
        return $contract->execute($projectUser);
    }
}
