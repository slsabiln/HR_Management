<?php

use App\Models\EmployeeVacation;
use App\Models\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class)->group('models');

uses()->group('models');

it('has fillable properties', function () {
    $model = new EmployeeVacation();

    expect($model->getFillable())->toEqual([
        'employee_id',
        'opening_vacations_count',
        'used_vacations_count',
    ]);
});

it('belongs to an employee', function () {
    $model = new EmployeeVacation();

    $relation = $model->employee();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class)
        ->and($relation->getRelated())->toBeInstanceOf(Employee::class);
});
