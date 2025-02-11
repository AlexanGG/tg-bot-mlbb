<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Вызов всех сидеров
        $this->call([
            HeroSeeder::class,
            RoleSeeder::class,
            TierListSeeder::class,
            BuildSeeder::class,
            BuildItemSeeder::class,
        ]);
    }
}
