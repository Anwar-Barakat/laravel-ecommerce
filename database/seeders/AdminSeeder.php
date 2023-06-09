<?php

namespace Database\Seeders;

use App\Models\Admin;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = Factory::create();
        $admins =  [
            [
                'name'              => 'admin',
                'email'             => 'admin@admin.com',
                'password'          => Hash::make('adminadmin'),
                'address'           => $faker->address(),
                'bio'               => $faker->paragraph(),
            ],
            [
                'name'              => 'anwar',
                'email'             => 'brkatanwar0@gmail.com',
                'password'          => Hash::make('adminadmin'),
                'address'           => $faker->address(),
                'bio'               => $faker->paragraph(),
            ],
        ];

        foreach ($admins as $admin) {
            if (is_null(Admin::where(['email' => $admin['email']])->first()))
                Admin::create($admin);
        }
    }
}