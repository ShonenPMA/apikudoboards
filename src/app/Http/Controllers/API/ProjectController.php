<?php

namespace App\Http\Controllers\API;

use App\Contracts\Project\CreateContract;
use App\Contracts\Project\DeleteContract;
use App\Contracts\Project\UpdateContract;
use App\Dtos\Project\CreateDto;
use App\Dtos\Project\UpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Project
 * @authenticated
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of the project from authenticated user.
     * @responseFile responses/project/indexFromAuthUser.json
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function indexFromAuthUser() : AnonymousResourceCollection
    {
        return ProjectResource::collection( 
            Project::where('user_id', request()->user()->id)
                ->filter(request()->get('filter', ''))
                ->orderBy('name', 'ASC')
                ->paginate(request()->get('per_page', 15)) 
        );
    }

    /**
     * Store a new project.
     * @responseFile responses/project/store.json
     * @param  \App\Http\Requests\Project\CreateRequest  $request
     * @param  \App\Contracts\Project\CreateContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $request, CreateContract $contract) : JsonResponse
    {
        return $contract->execute(CreateDto::fromRequest($request), request()->user());
    }

    /**
     * Update the specified project.
     * @responseFile responses/project/update.json
     * @param  \App\Http\Requests\Project\UpdateRequest  $request
     * @param  \App\Models\Project  $project
     * @param  \App\Contracts\Project\UpdateContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Project $project, UpdateContract $contract) : JsonResponse
    {
        return $contract->execute(UpdateDto::fromRequest($request), $project);
    }

    /**
     * Remove the specified project.
     *
     * @param  \App\Models\Project  $project
     * @param \App\Contracts\Project\DeleteContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Project $project, DeleteContract $contract) : JsonResponse
    {
        return $contract->execute($project);
    }
}
