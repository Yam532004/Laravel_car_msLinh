<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('cars')->insert([
        //     'description' => Str::random(50),
        //     'model' => Str::random(10),
        //     'produced_on' => Carbon::parse('01-01-2024'),
        //     'images' => 'anh1.jpg',
        // ]);
        
        Car::factory()
        ->count(5)
        ->create();
    }
}