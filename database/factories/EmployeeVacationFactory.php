<?php

namespace Database\Factories;

use App\Models\EmployeeVacation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeVacationFactory extends Factory
{
    protected $model = EmployeeVacation::class;

    public function definition()
    {
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'opening_vacations_count' => $this->faker->numberBetween(0, 30),
            'used_vacations_count' => $this->faker->numberBetween(0, 30),
        ];
    }
}
