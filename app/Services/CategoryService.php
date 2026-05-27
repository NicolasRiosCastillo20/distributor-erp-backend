<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {}


    /**
     * Get paginated list of categories.
     */
    public function paginate($perPage = 10)
    {
        return $this->categoryRepository
            ->paginate($perPage);
    }


    /**
     * Create a new category.
     */
    public function create(array $data): Category
    {
        $existingCategory = $this->categoryRepository
            ->findByName($data['name'], true);

        if ($existingCategory && $existingCategory->trashed()) {
            return $this->restore($existingCategory->id);
        }

        /**
         *  categorry already exists
         */

        if ($existingCategory) {
            throw ValidationException::withMessages([
                'name' => ['Category already exists.'],
            ]);
        }

        /**
         *  create new category
         */
        return $this->categoryRepository
            ->create($data);
    }


    /**
     * update an existing category.
     */
    public function update(Category $category, array $data): Category
    {
        return $this->categoryRepository
            ->update($category, $data);
    }


    /**
     * find a category by id.
     */
    public function findById(int $id): Category
    {
        return $this->categoryRepository
            ->findById($id);
    }


    /**
     * delete an existing category.
     */
    public function delete(Category $category): bool
    {
        return $this->categoryRepository
            ->delete($category);
    }


    /**
     * restore a deleted category.
     */
    public function restore(int $id): Category
    {
        $category = $this->categoryRepository
            ->restore($id);
        return $category;
    }
}
