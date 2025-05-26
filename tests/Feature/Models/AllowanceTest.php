<?php

use App\Models\EmployeeAllowance;
use App\Models\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class)->group('models');
uses()->group('models');

it('has fillable properties', function () {
    $model = new EmployeeAllowance();

    expect($model->getFillable())->toEqual([
        'employee_id',
        'allowance_type',
        'amount',
        'start_date',
        'end_date',
    ]);
});

it('belongs to an employee', function () {
    $model = new EmployeeAllowance();

    $relation = $model->employee();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class)
        ->and($relation->getRelated())->toBeInstanceOf(Employee::class);
});
