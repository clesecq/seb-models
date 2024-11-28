<?php

namespace Database\Factories;

use Database\Models\Product;
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
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));

        return [
            'name' => $this->faker->beverageName(),
            'price' => $this->faker->randomFloat(2, 0.5, 5),
            'category_id' => $this->faker->numberBetween(1, 5),
            'alert_level' => $this->faker->numberBetween(2, 10),
        ];
    }
}
