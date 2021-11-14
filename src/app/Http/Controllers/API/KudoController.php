<?php

namespace App\Http\Controllers\API;

use App\Contracts\Kudo\CreateContract;
use App\Dtos\Kudo\CreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kudo\CreateRequest;
use App\Models\Kudo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Kudo
 * @authenticated
 */
class KudoController extends Controller
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
     * Store a new kudo.
     * @responseFile responses/kudo/store.json
     * @param  \App\Http\Requests\Kudo\CreateRequest  $request
     * @param  \App\Contracts\Kudo\CreateContract $contract
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
     * @param  \App\Models\Kudo  $kudo
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Kudo $kudo)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kudo  $kudo
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Kudo $kudo)
    // {
    //     //
    // }
}
