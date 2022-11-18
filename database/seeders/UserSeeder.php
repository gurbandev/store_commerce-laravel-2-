<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Emir',
            'username' => 'emir',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Batyr',
            'username' => 'batyr',
            'password' => bcrypt('password'),
        ]);
    }
}
