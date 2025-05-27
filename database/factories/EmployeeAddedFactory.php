<?php

namespace Database\Factories;

use App\Models\EmployeeAdded;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeAddedFactory extends Factory
{
    protected $model = EmployeeAdded::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'note' => $this->faker->sentence(),
        ];
    }
}
