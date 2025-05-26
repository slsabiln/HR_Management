<?php

use App\Models\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\EmployeeVacation;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeSalaryBase;

uses(TestCase::class, RefreshDatabase::class)->group('models');
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