<?php

namespace Database\Factories;

use App\Domains\Children\Models\Child;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChildFactory extends Factory
{
    protected $model = Child::class;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'nickname' => fake()->firstName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'date_of_birth' => fake()->date(),
            'allergies' => fake()->sentence(),
            'special_educational_needs' => fake()->boolean(),
            'medical_notes' => fake()->sentence(),
            'dietary_requirements' => fake()->sentence(),
            'additional_languages' => fake()->sentence(),
            'religion' => fake()->randomElement(['Christianity', 'Islam', 'Hinduism', 'Buddhism', 'Sikhism']),
            'ethnic_origin' => fake()->randomElement(['white', 'black', 'asian']),
            'funding_type' => fake()->randomElement(['private', 'public']),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'notes' => fake()->sentence(),
            'is_active' => fake()->boolean(),
        ];
    }
}
