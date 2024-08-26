<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Category, Brand, Type};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);        
        Category::Create(['name' => 'nova categoria']);
        Brand::Create(['name' => 'nova marca']);
        Type::Create(['name' => 'novo tipo']);
    }
}
