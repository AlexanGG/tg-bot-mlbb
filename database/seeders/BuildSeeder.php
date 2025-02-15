<?php

namespace Database\Seeders;

use App\Models\Build;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Build::create([
            'hero_id' => 1, // ID героя (это пример, можно использовать реальный ID из таблицы heroes)
            'image' => 'example_build.png', // Заглушка для изображения сборки
        ]);
    }
}
