<?php

namespace Database\Factories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokemonFactory extends Factory
{

    protected $model = Pokemon::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'total' => $this->faker->randomNumber(),
            'hp' => $this->faker->randomNumber(),
            'attack' => $this->faker->randomNumber(),
            'defence' => $this->faker->randomNumber(),
            'special_attack' => $this->faker->randomNumber(),
            'special_defence' => $this->faker->randomNumber(),
            'speed' => $this->faker->randomNumber(),
            'generation' => $this->faker->randomNumber(),
            'legendary'=> $this->faker->boolean,
        ];
    }
}
