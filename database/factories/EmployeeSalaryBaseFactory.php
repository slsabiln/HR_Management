<?php

namespace Database\Factories;

use App\Models\EmployeeSalaryBase;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeSalaryBaseFactory extends Factory
{
    protected $model = EmployeeSalaryBase::class;

    public function definition()
    {
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'amount' => $this->faker->randomFloat(2, 1000, 5000),
            'year' => $this->faker->year(),
            'month' => $this->faker->numberBetween(1, 12),
        ];
    }
}
