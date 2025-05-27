<?php

use App\Models\EmployeeSalaryBase;
use App\Models\Employee;
use Illuminate\Validation\ValidationException;

uses()->group('models');

it('has fillable properties', function () {
    $model = new EmployeeSalaryBase();

    expect($model->getFillable())->toEqualCanonicalizing([
        'employee_id',
        'amount',
        'year',
        'month',
    ]);
});

it('belongs to an employee', function () {
    $model = new EmployeeSalaryBase();

    $relation = $model->employee();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class)
        ->and($relation->getRelated())->toBeInstanceOf(Employee::class);
});


it('does not allow duplicate salary base for same employee and month', function () {
    $employee = Employee::factory()->create();

    $year = now()->year;
    $month = now()->month;

    EmployeeSalaryBase::create([
        'employee_id' => $employee->id,
        'year' => $year,
        'month' => $month,
        'amount' => 1000,
    ]);

    $this->expectException(ValidationException::class);

    EmployeeSalaryBase::create([
        'employee_id' => $employee->id,
        'year' => $year,
        'month' => $month,
        'amount' => 1200,
    ]);
});
