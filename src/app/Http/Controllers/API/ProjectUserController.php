<?php

namespace App\Http\Controllers\API;

use App\Contracts\ProjectUser\CreateContract;
use App\Dtos\ProjectUser\CreateDto;
use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectUser\CreateRequest;

/**
 * @group Project User
 * @authenticated
 */
class ProjectUserController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    // public function destroy(ProjectUser $projectUser)
    // {
    //     //
    // }
}
