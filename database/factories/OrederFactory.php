<?php

namespace Database\Factories;

use App\Models\Oreder;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrederFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Oreder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total-couble' => $this->faker->numberBetween(23, 200),
            'payment_txp' => $this->faker->randomElement(['foo', 'bar']),
            'status' => $this->faker->randomElement(['active', 'disable']),
            'users_id' => $this->faker->numberBetween(1, 14),
            'total' => $this->faker->numberBetween(100, 600)
        ];
    }
}
