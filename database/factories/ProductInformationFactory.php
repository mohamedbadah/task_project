<?php

namespace Database\Factories;

use App\Models\ProductInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bar_cod' => $this->faker->word(),
            'pusching_price' => $this->faker->randomNumber(),
            'purchased_count' => $this->faker->numberBetween(12, 124),
            'product_id' => $this->faker->unique()->numberBetween(1, 30)
        ];
    }
}
