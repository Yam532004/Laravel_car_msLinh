<?php

namespace Database\Seeders;

use App\Models\Mf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Mf::factory()
        ->count(50)
        ->create();
    }
}
