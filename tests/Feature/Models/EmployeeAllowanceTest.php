<?php


it('belongs to an allowance type', function () {
    $model = new \App\Models\EmployeeAllowance();

    $relation = $model->allowanceType();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class)
        ->and($relation->getRelated())->toBeInstanceOf(\App\Models\AllowanceType::class);
});
