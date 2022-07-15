<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_code' => $this->faker->numberBetween(1000,2000),
            'ref_code' => $this->faker->numberBetween(1000,2000),
            'name' => $this->faker->text,
            'decription' => $this->faker->text,
            'created_by' => 'Faker'
        ];
    }
}
