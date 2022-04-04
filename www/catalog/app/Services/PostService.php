<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class PostService implements \App\Contracts\Services\PostService
{
    public function paginate(Builder $builder, int $page, int $perPage): Paginator
    {
        return $builder->paginate(perPage: $perPage, page: $page);
    }

    public function allBuilder(): Builder
    {
        return $this->withCategories(Post::select('id', 'title', 'preview'));
    }

    public function getBuilderByCategory(int $category_id)
    {
        $builder = Post::whereHas('categories', function (Builder $q) use ($category_id){
            return $q->where('id', $category_id);
        });
        return $this->withCategories($builder);
    }

    private function withCategories(Builder $builder)
    {
        return $builder->with('categories', function (BelongsToMany $q) {
            $q->select('id', 'title');
        });
    }
}