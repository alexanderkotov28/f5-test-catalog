<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DumpSeeder extends Seeder
{
    const FILES = [
        'sql/posts.sql',
        'sql/categories.sql',
        'sql/category_post.sql'
    ];
    public function run()
    {
        foreach (self::FILES as $file){
            DB::statement(file_get_contents(database_path($file)));
        }
    }
}