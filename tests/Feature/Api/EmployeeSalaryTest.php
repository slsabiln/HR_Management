<?php

use App\Models\Employee;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeAddition;
use function Pest\Laravel\getJson;
use App\Models\EmployeeSalaryBase;

it('calculates total salary correctly', function () {
    // إنشاء الموظف
    $employee = Employee::factory()->create();

    EmployeeSalaryBase::factory()->create([
        'employee_id' => $employee->id,
        'amount' => 5000,
        'year' => 2025,
        'month' => 5,
    ]);


    // إنشاء بدل (Allowances)
    EmployeeAllowance::factory()->create([
        'employee_id' => $employee->id,
        'amount' => 1000,
    ]);

    EmployeeAllowance::factory()->create([
        'employee_id' => $employee->id,
        'amount' => 500,
    ]);

    // إنشاء إضافات (Additions)
    EmployeeAddition::factory()->create([
        'employee_id' => $employee->id,
        'amount' => 300,
    ]);

    // استدعاء الراوت
    $response = getJson("/api/employees/{$employee->id}/salary");

    $response->assertOk()
        ->assertJson([
            'base_salary' => 5000,
            'total_allowances' => 1500,
            'total_additions' => 300,
            'total_salary' => 6800,
        ]);
});
