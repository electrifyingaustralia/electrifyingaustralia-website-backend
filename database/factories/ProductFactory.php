<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\MediaLibrary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productTypes = ['solar_panel', 'battery', 'ev_charger', 'inverter'];

        return [
            'name' => $this->faker->words(3, true),
            'model_number' => strtoupper($this->faker->bothify('MOD-#####-##')),
            'short_description' => $this->faker->sentence(10),
            'brand_id' => Brand::inRandomOrder()->first()->id ?? null,
            'warranty' => $this->faker->randomElement(['1 year', '2 years', '3 years', '5 years', '10 years', '25 years']),
            'is_featured' => $this->faker->boolean(30), // 30% chance of being featured
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            'product_link' => $this->faker->url(),
            'media_id' => MediaLibrary::inRandomOrder()->first()->id ?? null,
            'product_type' => $this->faker->randomElement($productTypes),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
