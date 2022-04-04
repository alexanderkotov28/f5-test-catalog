<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => env('NEWS_API_KEY'),
            'pageSize' => 100,
            'language' => 'en'
        ]);

        foreach ($response->json('articles') as $article) {
            if (is_null($article['description'])) {
                continue;
            }

            $postId = DB::table('posts')->insertGetId([
                'title' => $article['title'],
                'preview' => $article['description'],
                'text' => $article['description']
            ]);

            $this->setCategories($postId);
        }
    }

    private function setCategories(int $postId)
    {
        foreach (Category::inRandomOrder()->take(rand(1,3))->get() as $category){
            DB::table('category_post')->insert([
                'post_id' => $postId,
                'category_id' => $category->id
            ]);
        }
    }
}
