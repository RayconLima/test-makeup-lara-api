<?php

namespace Database\Seeders;

use App\Models\{User, Category, Brand, Type};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::Create(['name' => 'nova categoria']);
        Brand::Create(['name' => 'nova marca']);
        Type::Create(['name' => 'novo tipo']);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
