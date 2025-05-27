<?php

use App\Models\AllowanceType;
use App\Models\EmployeeAllowance;


it('has fillable properties', function () {
    $model = new AllowanceType();

    expect($model->getFillable())->toEqual(['name']);
});

it('has many employee allowances', function () {
    $model = new AllowanceType();

    $relation = $model->employeeAllowances();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class)
        ->and($relation->getRelated())->toBeInstanceOf(EmployeeAllowance::class);
});
