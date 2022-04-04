<?php

namespace App\Http\Controllers;

use App\Resources\PaginationResource;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private PostService $postService;

    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->categoryService->all();
    }

    public function postsByCategoryId(Request $request, int $category_id)
    {
        return new PaginationResource($this->postService->paginate(
            $this->postService->getBuilderByCategory($category_id),
            $request->get('page', 1),
            $request->get('perPage', 10)
        ));
    }
}
