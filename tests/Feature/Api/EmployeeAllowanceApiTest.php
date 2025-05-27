<?php

use App\Models\Employee;
use App\Models\EmployeeAllowance;;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\deleteJson;

it('can list employee allowances', function () {
    $employee = Employee::factory()->create();
    EmployeeAllowance::factory()->count(2)->create(['employee_id' => $employee->id]);

    $response = getJson('/api/employee-allowances');

    $response->assertOk()->assertJsonCount(2, 'data');
});

it('can create an employee allowance', function () {
    $employee = Employee::factory()->create();

    $data = [
        'employee_id' => $employee->id,
        'type' => 'Housing Allowance',
        'amount' => 500.00,
        'start_date' => '2024-01-01',
        'end_date' => '2024-12-31',
    ];

    $response = postJson('/api/employee-allowances', $data);

    $response->assertCreated()->assertJsonFragment(['type' => 'Housing Allowance']);
    $this->assertDatabaseHas('employee_allowances', $data);
});


it('can update an employee allowance', function () {
    $allowance = EmployeeAllowance::factory()->create();

    $data = [
        'employee_id' => $allowance->employee_id,
        'type' => 'Updated Allowance',
        'amount' => 500.00,
        'start_date' => '2024-01-01',
        'end_date' => '2024-12-31',
    ];

    $response = putJson("/api/employee-allowances/{$allowance->id}", $data);

    $response->assertOk()->assertJsonFragment(['type' => 'Updated Allowance']); // ✅ عدل التوقع
    $this->assertDatabaseHas('employee_allowances', ['id' => $allowance->id, 'type' => 'Updated Allowance']);
});


it('can delete an employee allowance', function () {
    $allowance = EmployeeAllowance::factory()->create();

    $response = deleteJson("/api/employee-allowances/{$allowance->id}");

    $response->assertNoContent();
    $this->assertDatabaseMissing('employee_allowances', ['id' => $allowance->id]);
});
