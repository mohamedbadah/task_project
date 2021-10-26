<?php

namespace Database\Factories;

use App\Models\OrederProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrederProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrederProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10),
            'oreder_id' => $this->faker->numberBetween(10, 20),
            'count' => $this->faker->randomNumber(),
            'item_price' => $this->faker->numberBetween(233, 1000),
            'total' => $this->faker->numberBetween(233, 1000)
        ];
    }
}
