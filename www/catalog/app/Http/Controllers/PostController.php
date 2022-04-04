<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Resources\PaginationResource;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request): PaginationResource
    {
        return new PaginationResource($this->postService->paginate(
            $this->postService->allBuilder(),
            $request->get('page', 1),
            $request->get('perPage', 10)
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        return $post->load('categories');
    }

}
