<?php

namespace Database\Factories;

use App\Models\sub_categories;
use Illuminate\Database\Eloquent\Factories\Factory;

class sub_categoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = sub_categories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     *
     */
    public function definition()
    {
        $array = ['visible', 'invisible'];
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->word(),
            'status' => $this->faker->randomElement(['visible', 'invisible']),
            'categories_id' => $this->faker->numberBetween(1, 17)

        ];
    }
}
