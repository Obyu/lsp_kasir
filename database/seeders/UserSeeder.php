<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUser::insert([
            [    'nama' => 'Bayu',
                'password' => Hash::make('123'),
                'level' => 'admin',
            ],
            [
                'nama' => 'Rere',
                'password' => Hash::make('123'),
                'level' => 'waiter',
            ],
            [
                'nama' => 'yuba',
                'password' => Hash::make('123'),
                'level' => 'kasir',
            ],
            [
                'nama' => 'johari',
                'password' => Hash::make('123'),
                'level' => 'owner',
            ]
            ]);
    }
}
