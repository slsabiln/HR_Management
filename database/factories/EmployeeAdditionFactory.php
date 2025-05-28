<?php

namespace Database\Factories;

use App\Models\EmployeeAddition;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeAdditionFactory extends Factory
{
    protected $model = EmployeeAddition::class;

    public function definition()
    {
        return [
            'employee_id' => Employee::factory(), // مرتبط بموظف جديد
            'type' => $this->faker->randomElement(['مكافأة', 'بدل نقل إضافي']),
            'amount' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
