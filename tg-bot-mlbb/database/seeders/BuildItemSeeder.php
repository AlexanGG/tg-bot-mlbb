<?php

namespace Database\Seeders;

use App\Models\BuildItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BuildItem::create([
            'build_id' => 1, // ID сборки (это пример, можешь использовать реальный ID из таблицы builds)
            'type' => 'item', // Тип (предмет)
            'image' => 'example_item.png', // Заглушка для изображения предмета
        ]);
    }
}
