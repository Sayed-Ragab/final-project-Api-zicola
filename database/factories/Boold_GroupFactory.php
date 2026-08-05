<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class Boold_GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            
            'name' => $this->faker->unique()->randomElement(['A+', 'A-', 'B+', 'B-','O+', 'O-','AB+', 'AB-']),
        ];
        
    }
}
