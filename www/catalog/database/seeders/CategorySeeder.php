<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        foreach ($this->getItems() as $category) {
            DB::table('categories')->insert($category);
        }
    }

    private function getItems(): array
    {
        $categories = ['Банкротства', 'Партнерские проекты', 'Картотека', 'Конференции', 'Университетъ', 'Подписка', 'Реклама', 'Фотоагентство', 'Газета', 'Weekend', 'Приложения', 'Автопилот', 'Наука', 'Деньги', 'Регионы', 'Экономика', 'Политика', 'Мир', 'Бизнес', 'Финансы', 'Потребительский рынок', 'Телекоммуникации', 'Общество', 'Происшествия', 'Культура', 'Спорт', 'Hi-Tech', 'Авто', 'Стиль', 'Темы', 'Тенденции', 'Мультимедиа', 'Интервью', 'Справочники', 'Самое читаемое', 'E-mail рассылки'];

        $struct = [];

        $i = 1;
        foreach ($categories as $category) {
            $cat = [
                'title' => $category,
                'id' => $i++,
                'children' => []
            ];
            if ($i > 5) {
                $rand = rand(0, 5);
                switch (true) {
                    case $rand >= 0 && $rand < 3:
                        $struct[array_rand($struct)]['children'][] = $cat;
                        break;
                    case $rand >= 3:
                        $this->setSub($struct, $cat);
                        break;
                }
            } else {
                $struct[] = $cat;
            }
        }

        $result = [];

        foreach ($struct as $category) {
            $result = array_merge($result, $this->getPlain($category));
        }

        return $result;
    }

    private function setSub(array &$struct, array $cat, array $notSuitable = []): void
    {
        $index = $this->getIndex($struct, $notSuitable);
        if (!empty($struct[$index]['children'])) {
            $struct[$index]['children'][array_rand($struct[$index]['children'])]['children'][] = $cat;
        } else {
            $notSuitable[] = $index;
            $this->setSub($struct, $cat, $notSuitable);
        }
    }

    private function getIndex(array $struct, array $notSuitable = [])
    {
        $index = array_rand($struct);
        if (!in_array($index, $notSuitable)) {
            return $index;
        } else {
            return $this->getIndex($struct, $notSuitable);
        }
    }

    private function getPlain(array $category, ?int $parent_id = null)
    {
        if (empty($category['children'])) {
            return [[
                'title' => $category['title'],
                'id' => $category['id'],
                'parent_id' => $parent_id
            ]];
        } else {
            $data = [];
            foreach ($category['children'] as $child) {
                $data = array_merge($data, $this->getPlain($child, $category['id']));
            }
            $data[] = [
                'title' => $category['title'],
                'id' => $category['id'],
                'parent_id' => $parent_id
            ];
            return $data;
        }
    }
}
