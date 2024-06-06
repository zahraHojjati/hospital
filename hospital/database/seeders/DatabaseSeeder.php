<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('setting')->insert([
            [
                'label' => 'تصویر محصول',
                'name' => 'تصویر',
                'value' => '01732323232',
                'group' => 'general',
                'type' => 'image',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'label' => 'شماره تماس پشتیبانی',
                'name' => 'support_time',
                'value' => '10 تا 15',
                'group' => 'general',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'label' => 'اینستاگرام',
                'name' => 'mentorship',
                'value' => '1365',
                'group' => 'social',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'label' => 'تلگرام',
                'name' => 'address',
                'value' => '09117508268',
                'group' => 'social',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
