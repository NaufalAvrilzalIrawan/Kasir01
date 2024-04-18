<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'Admin@gmail.com',
            'role' => 1,
            'alamat' => 'Jl. admin no. 3741',
            'telepon' => '081111111111',
            'password' => bcrypt('12345678'), // You should hash passwords in production
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
