<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
