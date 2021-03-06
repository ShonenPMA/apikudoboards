<?php

namespace App\Http\Controllers\API;

use App\Contracts\Kudo\CreateContract;
use App\Contracts\Kudo\DeleteContract;
use App\Contracts\Kudo\UpdateContract;
use App\Dtos\Kudo\CreateDto;
use App\Dtos\Kudo\UpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kudo\CreateRequest;
use App\Http\Requests\Kudo\UpdateRequest;
use App\Http\Resources\KudoResource;
use App\Models\Kudo;
use App\Models\Kudoboards;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Kudo
 * @authenticated
 */
class KudoController extends Controller
{
    /**
     * Display a listing of the kudos from a kudoboard.
     * @responseFile responses/kudo/indexFromKudoboard.json
     * @param \App\Models\Kudoboards $kudoboard
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
     */
    public function indexFromKudoboard(Kudoboards $kudoboards) : AnonymousResourceCollection
    {
        return  KudoResource::collection(
            Kudo::where('kudoboard_id', $kudoboards->id)
                ->with(['sender', 'receiver'])
                ->orderBy('created_at', 'DESC')
                ->get()
        );
    }

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
     * Update the specified kudo.
     * @responseFile responses/kudo/update.json
     * @param  \App\Http\Requests\Kudo\UpdateRequest  $request
     * @param  \App\Models\Kudo  $kudo
     * @param  \App\Contracts\Kudo\UpdateContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Kudo $kudo, UpdateContract $contract)
    {
        return $contract->execute(UpdateDto::fromRequest($request), $kudo);
    }

    /**
     * Remove the specified kudo.
     * @responseFile responses/kudo/destroy.json
     * @param  \App\Models\Kudo  $kudo
     * @param \App\Contracts\Kudo\DeleteContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Kudo $kudo, DeleteContract $contract) : JsonResponse
    {
        return $contract->execute($kudo);
    }
}
