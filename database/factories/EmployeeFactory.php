<?php

namespace Database\Factories;

use App\Models\Employee;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
        'code' => 'EMP' . $this->faker->unique()->numberBetween(100, 999),
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->phoneNumber(),
        'hire_date' => fake()->date(),
        'birth_date' => fake()->date(),
        'job_title' => fake()->jobTitle(),
        'department' => fake()->word(),
    ];

    }
}
