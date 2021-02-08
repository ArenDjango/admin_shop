<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'status' => 'accepted',
            'role' => 'admin',
            'password' => bcrypt('adminadmin')
        ]);
        foreach (['LAMPS', 'LAMP REFILL', 'BOUQUET & BOUQUET REFILL', 'LAMP GIFTSETS', 'CANDLES', 'CAR & MIST DIFF'] as $category){
            Category::create(['category_title' => $category]);
        }
        // \App\Models\User::factory(10)->create();
    }
}
