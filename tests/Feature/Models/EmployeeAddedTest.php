<?php

use App\Models\Employee;
use App\Models\EmployeeAdded;


it('has fillable properties', function () {
    $model = new EmployeeAdded();

    expect($model->getFillable())->toEqual([
        'employee_id',
        'note',
    ]);
});

it('belongs to an employee', function () {
    $employee = Employee::factory()->create();

    $employeeAdded = EmployeeAdded::factory()->create([
        'employee_id' => $employee->id,
    ]);

    expect($employeeAdded->employee)->toBeInstanceOf(Employee::class);
});


