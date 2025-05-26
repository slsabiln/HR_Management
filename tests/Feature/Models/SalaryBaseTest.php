<?php

use App\Models\EmployeeSalaryBase;
use App\Models\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class)->group('models');
uses()->group('models');

it('has fillable properties', function () {
    $model = new EmployeeSalaryBase();

    expect($model->getFillable())->toEqual([
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
