<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreatAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@legendTower.tj',
                'password' => Hash::make('123123123'),
                'role' => 'legend_tower'
            ],
            [
                'name' => 'Admin_298mkr',
                'email' => 'admin@mkr298.tj',
                'password' => Hash::make('123123123'),
                'role' => '298_mkr'
            ],
        ];

        foreach ($users as $userData) {
            // Check if the user already exists
            $user = User::where('email', $userData['email'])->first();

            // If the user does not exist, create it
            if (!$user) {
                User::create($userData);
            }
        }
    }
}
