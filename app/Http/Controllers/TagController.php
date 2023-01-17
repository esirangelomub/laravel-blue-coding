<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TagController extends Controller
{
    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function index(Post $post): JsonResponse
    {
        $tags = $post->tags()->paginate($this->paginate);
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function store(StoreTagRequest $request, Post $post): JsonResponse
    {
        $tag = $post->tags()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Tag Created successfully!",
            'data' => $tag
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function show(Tag $tag): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return JsonResponse
     */
    public function update(UpdateTagRequest $request, Tag $tag): JsonResponse
    {
        $tag->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Tag Updated successfully!",
            'data' => $tag
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();
        return response()->json([
            'status' => true,
            'message' => "Tag Deleted successfully!"
        ]);
    }
}
