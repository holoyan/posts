<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\GetPostRequest;
use App\Http\Requests\Posts\PostStoreRequest;
use App\Http\Resources\Posts\PostResource;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(private PostService $service)
    {}

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

    /**
     * @param GetPostRequest $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index(GetPostRequest $request, $userId)
    {
        $posts = $this->service->search(
            array_merge(
                $request->validated(),
                [
                    'perPage' => min(request()->get('perPage', 10), 100),
                    'page' => $request->get('page', 1)
                ]
            ),
            $userId
        );

        return response()->json(
            PostResource::collection($posts)
        );
    }
}
