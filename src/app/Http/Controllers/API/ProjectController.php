<?php

namespace App\Http\Controllers\API;

use App\Contracts\Project\CreateContract;
use App\Dtos\Project\CreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Project
 * @authenticated
 */
class ProjectController extends Controller
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
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    // public function show(Project $project)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Project $project)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Project $project)
    // {
    //     //
    // }
}
