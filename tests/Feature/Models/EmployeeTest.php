<?php

use App\Models\Employee;

use App\Models\EmployeeVacation;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeSalaryBase;
use Illuminate\Validation\ValidationException;
uses()->group('models');

it('throws validation exception if vacation days are negative on create', function () {
    // نستخدم فكتوري الموظف عشان نربط الإجازة بموظف موجود
    $employee = \App\Models\Employee::factory()->create();

    // نتوقع رمي ValidationException لو حاولنا ننشئ إجازة بعدد أيام سالبة
    $this->expectException(ValidationException::class);

    EmployeeVacation::create([
        'employee_id' => $employee->id,
        'opening_vacations_count' => -5,  // قيمة سالبة
        'used_vacations_count' => 0,
    ]);
});

it('throws validation exception if vacation days are negative on update', function () {
    $employee = \App\Models\Employee::factory()->create();

    $vacation = EmployeeVacation::create([
        'employee_id' => $employee->id,
        'opening_vacations_count' => 10,
        'used_vacations_count' => 5,
    ]);

    $this->expectException(ValidationException::class);

    // محاولة تحديث بقيمة سالبة
    $vacation->update([
        'used_vacations_count' => -1,
    ]);
});

it('has correct fillable properties', function () {
    $employee = new Employee();

    $expected = [
        'code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'hire_date',
        'birth_date',
        'job_title',
        'department',
    ];

    expect($employee->getFillable())->toEqual($expected);
});

it('has many vacations', function () {
    $employee = new Employee();

    $relation = $employee->vacations();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class)
        ->and($relation->getRelated())->toBeInstanceOf(EmployeeVacation::class);
});

it('has many allowances', function () {
    $employee = new Employee();

    $relation = $employee->allowances();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class)
        ->and($relation->getRelated())->toBeInstanceOf(EmployeeAllowance::class);
});

it('has many salary bases', function () {
    $employee = new Employee();

    $relation = $employee->salaryBases();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class)
        ->and($relation->getRelated())->toBeInstanceOf(EmployeeSalaryBase::class);
});

it('has many managers via employees_managers table', function () {
    $employee = new Employee();

    $relation = $employee->managers();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class)
        ->and($relation->getRelated())->toBeInstanceOf(Employee::class);
});

