<?php

use App\Models\Employee;
use App\Models\EmployeeVacation;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\deleteJson;


it('can list employee vacations', function () {
    $employee = Employee::factory()->create();
    EmployeeVacation::factory()->count(3)->create(['employee_id' => $employee->id]);

    $response = getJson('/api/employee-vacations');

    $response->assertOk()->assertJsonCount(3, 'data');
});

it('can create an employee vacation', function () {
    $employee = Employee::factory()->create();

    $data = [
        'employee_id' => $employee->id,
        'opening_vacations_count' => 20,
        'used_vacations_count' => 5,
    ];


    $response = postJson('/api/employee-vacations', $data);
    $response->assertCreated();
    $this->assertDatabaseHas('employee_vacations', $data);
});

it('can update an employee vacation', function () {
    $employee = Employee::factory()->create();
    $vacation = EmployeeVacation::factory()->create(['employee_id' => $employee->id]);
    $data = [
        'employee_id' => $employee->id,
        'opening_vacations_count' => 20,
        'used_vacations_count' => 5,
    ];


    $response = putJson("/api/employee-vacations/{$vacation->id}", $data);
    $response->assertOk();
    $this->assertDatabaseHas('employee_vacations', ['id' => $vacation->id] + $data);
});

it('can delete an employee vacation', function () {
    $vacation = EmployeeVacation::factory()->create();

    $response = deleteJson("/api/employee-vacations/{$vacation->id}");

    $response->assertNoContent();
    $this->assertDatabaseMissing('employee_vacations', ['id' => $vacation->id]);
});
