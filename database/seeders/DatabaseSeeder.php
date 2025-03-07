<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
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
