<?php

namespace Database\Seeders;

use App\Models\Pool;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pool::factory()
            ->count(10)
            ->create();
    }
}
