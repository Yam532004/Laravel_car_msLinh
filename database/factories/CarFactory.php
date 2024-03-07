<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->text(10),
            "model" => $this->faker->text(10).'@example.com',
            "images" => "car".($this->faker->numberBetween(1, 3)).".jpg",
            "produced_on" =>$this->faker->dateTime(),
            "created_at" =>$this->faker->dateTime(),
            "updated_at" =>$this->faker->dateTime(),
        ];
    }
}
