<?php

namespace Database\Factories;


use App\Models\Wolf;
use App\Models\Pack;
use Illuminate\Database\Eloquent\Factories\Factory;

class WolfFactory extends Factory
{

    protected $model = Wolf::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birthdate' => $this->faker->date(),
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->longitude(),
            'pack_id' => Pack::inRandomOrder()->first()
        ];
    }
}
