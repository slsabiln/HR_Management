<?php

use Illuminate\Support\Facades\Schema;

it('has all expected columns in employees table', function () {
    expect(Schema::hasTable('employees'))->toBeTrue();

    $expectedColumns = [
        'id',
        'code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'hire_date',
        'birth_date',
        'job_title',
        'department',
        'created_at',
        'updated_at',
    ];

    foreach ($expectedColumns as $column) {
        expect(Schema::hasColumn('employees', $column))
            ->toBeTrue("Failed asserting that column [$column] exists in employees table.");
    }
});
