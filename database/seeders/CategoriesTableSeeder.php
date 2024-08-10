<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Январь-2024'],
            ['name' => 'Февраль-2024'],
            ['name' => 'Март-2024'],
            ['name' => 'Апрель-2024'],
            ['name' => 'Май-2024'],
            ['name' => 'Июнь-2024'],
            ['name' => 'Июль-2024'],
            ['name' => 'Август-2024'],
            ['name' => 'Сентябрь-2024'],
            ['name' => 'Октябрь-2024'],
            ['name' => 'Ноябрь-2024'],
            ['name' => 'Декабрь-2024'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
