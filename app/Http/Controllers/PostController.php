<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\PostStoreRequest;
use App\Http\Resources\Posts\PostResource;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
//    public function __construct(private PostService $service)
//    {}

    private $service;
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * @param PostStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostStoreRequest $request)
    {
        $post = $this->service->store($request->validated());

        return response()->json(
            new PostResource($post)
        );
    }
}
