<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KudoboardsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Kudoboards
 * @authenticated
 */
class KudoboardController extends Controller
{
    /**
     * Display list of all kudoboards from authenticated user
     * @responseFile responses/kudoboards/index.json
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return KudoboardsResource::collection(
            request()
                ->user()
                ->all_kudoboards
        );
    }
}
