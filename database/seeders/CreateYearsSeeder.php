<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateYearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            ['year' => '2023'],
            ['year' => '2024']
        ];

        foreach ($years as $year) {
            Year::create($year);
        }
    }
}
