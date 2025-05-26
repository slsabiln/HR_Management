<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

uses(Tests\TestCase::class);

it('has employee_vacations table with all expected columns and foreign key', function () {
    // تأكد من وجود الجدول
    expect(Schema::hasTable('employee_vacations'))->toBeTrue();

    $expectedColumns = [
        'id',
        'employee_id',
        'opening_vacations_count',
        'used_vacations_count',
        'created_at',
        'updated_at',
    ];

    // تأكد من وجود كل عمود في الجدول
    foreach ($expectedColumns as $column) {
        expect(Schema::hasColumn('employee_vacations', $column))
            ->toBeTrue("Failed asserting that column [$column] exists in employee_vacations table.");
    }

    // تحقق من وجود المفتاح الأجنبي employee_id مرتبط بـ employees.id
    $foreignKeys = DB::select("
        SELECT
            CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        FROM
            information_schema.KEY_COLUMN_USAGE
        WHERE
            TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = 'employee_vacations'
            AND COLUMN_NAME = 'employee_id'
            AND REFERENCED_TABLE_NAME = 'employees'
            AND REFERENCED_COLUMN_NAME = 'id'
    ");

    expect(count($foreignKeys))->toBeGreaterThan(0);
});
