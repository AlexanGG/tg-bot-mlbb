<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create(['name' => 'Layla', 'image' => 'Layla.png']);
        Hero::create(['name' => 'Julian', 'image' => 'julian.png']);
        Hero::create(['name' => 'Joy', 'image' => 'joy.png']);
        Hero::create(['name' => 'Granger', 'image' => 'granger.png']);
    }
}
