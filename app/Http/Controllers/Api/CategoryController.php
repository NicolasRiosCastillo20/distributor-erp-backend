<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ){}


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoryService
            ->paginate($request->query("per_page", 10)
        );

        return response()->json($categories);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService
            ->create($request->validated());

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update (UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $updatedCategory = $this->categoryService
            ->update($category, $request->validated());
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $updatedCategory
        ], 200);
    }


    /**
     * show Category
     */
    public function show (int $id): JsonResponse
    {
        $category = $this->categoryService->findById($id);
        return response()->json([
            'data' => $category
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Category $category): JsonResponse
    {
        $this->categoryService->delete($category);
        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }

}
