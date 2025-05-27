<?php

use App\Models\EmployeeManager;
use App\Models\Employee;


it('has fillable properties', function () {
    $model = new EmployeeManager();

    expect($model->getFillable())->toEqual([
        'employee_id',
        'manager_id',
    ]);
});

it('belongs to an employee', function () {
    $model = new EmployeeManager();

    $relation = $model->employee();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class)
        ->and($relation->getRelated())->toBeInstanceOf(Employee::class);
});

it('belongs to a manager (employee)', function () {
    $model = new EmployeeManager();

    $relation = $model->manager();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class)
        ->and($relation->getRelated())->toBeInstanceOf(Employee::class);
});
