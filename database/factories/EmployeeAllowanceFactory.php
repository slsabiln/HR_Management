<?php

namespace Database\Factories;

use App\Models\EmployeeAllowance;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeAllowanceFactory extends Factory
{
    protected $model = EmployeeAllowance::class;

    public function definition()
    {
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'type' => $this->faker->randomElement(['housing', 'transportation', 'food', 'medical']),
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'end_date' => $this->faker->optional()->dateTimeBetween('now', '+1 year')
                ?->format('Y-m-d'),

        ];
    }
}
