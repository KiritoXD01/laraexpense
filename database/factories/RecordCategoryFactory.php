<?php

namespace Database\Factories;

use App\Models\RecordCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RecordCategory>
 */
class RecordCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
        ];
    }
}
