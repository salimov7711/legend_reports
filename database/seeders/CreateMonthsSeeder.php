<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateMonthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            ['month' => 'Январь'],
            ['month' => 'Февраль'],
            ['month' => 'Март'],
            ['month' => 'Апрель'],
            ['month' => 'Май'],
            ['month' => 'Июнь'],
            ['month' => 'Июль'],
            ['month' => 'Август'],
            ['month' => 'Сентябрь'],
            ['month' => 'Октябрь'],
            ['month' => 'Ноябрь'],
            ['month' => 'Декабрь'],
        ];

        foreach ($months as $month ) {
            Month::create($month);
        }
    }
}
