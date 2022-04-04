<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function all()
    {
        return Category::all([
            'id',
            'title',
            'parent_id'
        ]);
    }
}