<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class Dataawal extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Karyawan 1
        User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('87654321'),
            'role' => 'admin',
        ]);
    }
}
