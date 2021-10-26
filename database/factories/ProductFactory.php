<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'active' => $this->faker->boolean(),
            'title' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100, 1000),
            'code' => $this->faker->unique()->numberBetween(1, 300),
            'sub_categories_id' => $this->faker->numberBetween(1, 8)
        ];
    }
}
