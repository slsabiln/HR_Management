<?php

namespace Tests\Feature\Feature\Database;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

uses(TestCase::class);

it('has all expected columns in employee_salary_base table', function () {
    expect(Schema::hasTable('employee_salary_base'))->toBeTrue();

    $expectedColumns = [
        'id',
        'employee_id',
        'amount',
        'year',
        'month',
        'created_at',
        'updated_at',
    ];

    foreach ($expectedColumns as $column) {
        expect(Schema::hasColumn('employee_salary_base', $column))
            ->toBeTrue("Failed asserting that column [$column] exists in employee_salary_base table.");
    }
});

