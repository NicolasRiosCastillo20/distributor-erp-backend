<?php

namespace App\Repositories;
use App\Models\Category;

class CategoryRepository
{
    public function paginate($perPage = 10)
    {
        return Category::paginate($perPage);
    }


    public function create(array $data): Category
    {
        return Category::create($data);
    }


    public function findById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function findByName(string $name, bool $withTrashed = false): ?Category
    {
        $query = Category::where('name', $name);
        if ($withTrashed) {
            $query->withTrashed();
        }
        return $query->first();
    }


    public function update (Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete (Category $category): bool
    {
        return $category->delete();
    }


    public function restore (int $id): Category
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return $category;
    }

}
