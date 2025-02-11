<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Roamer']);
        Role::create(['name' => 'Mid']);
        Role::create(['name' => 'Jungle']);
        Role::create(['name' => 'AD Carry']);
        Role::create(['name' => 'Exp Lane']);
    }
}
