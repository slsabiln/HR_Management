<?php

namespace Tests\Feature\Database;

use Illuminate\Support\Facades\Schema;


it('has all expected columns in employee_allowances table', function () {
    expect(Schema::hasTable('employee_allowances'))->toBeTrue();

    $expectedColumns = [
        'id',
        'employee_id',
        'type',
        'amount',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    foreach ($expectedColumns as $column) {
        expect(Schema::hasColumn('employee_allowances', $column))
            ->toBeTrue("Failed asserting that column [$column] exists in employee_allowances table.");
    }
});
