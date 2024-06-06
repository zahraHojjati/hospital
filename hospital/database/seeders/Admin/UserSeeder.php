<?php

namespace Database\Seeders\Admin;

use App\Models\User;
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
        $superAdmin=User::find(1);
        $superAdmin->save();

        $admin=User::firstOrCreate([
            'id' => 1,
            'name' => 'zahra hojati',
            'mobile' => '09115248979',
            'email' => 'zahra_hojati171@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'status' => 1
        ]);
        $admin->assignRole('admin');

        $doctor=User::firstOrCreate([
            'id' => 1,
            'name' => 'fatemeh kabusi',
            'mobile' => '09117508268',
            'email' => 'fatemeh_kabusi171@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'status' => 1
        ]);
        $doctor->assignRole('doctor');
    }
}
