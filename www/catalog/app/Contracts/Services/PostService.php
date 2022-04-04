<?php

namespace App\Contracts\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

interface PostService
{
    public function paginate(Builder $builder, int $page, int $perPage): Paginator;

    public function allBuilder(): Builder;
}