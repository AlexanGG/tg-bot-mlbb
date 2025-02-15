<?php

namespace Database\Seeders;

use App\Models\Tier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TierListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tier::create(['name' => 'S+']);
        Tier::create(['name' => 'S']);
        Tier::create(['name' => 'A']);
        Tier::create(['name' => 'B']);
        Tier::create(['name' => 'C']);
    }
}
