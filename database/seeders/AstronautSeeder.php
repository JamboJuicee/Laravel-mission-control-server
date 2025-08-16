<?php

namespace Database\Seeders;

use App\Models\Astronaut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AstronautSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Astronaut::factory(30) -> create();
    }
}
