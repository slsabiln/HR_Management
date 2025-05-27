<?php

use App\Models\Employee;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\deleteJson;

it('can list employees', function () {
    Employee::factory()->count(3)->create();

    $response = getJson('/api/employees');

    $response->assertStatus(200)
             ->assertJsonCount(3);
});

it('can create an employee', function () {
    $data = Employee::factory()->make()->toArray();

    $response = postJson('/api/employees', $data);

    $response->assertStatus(201)
             ->assertJsonFragment([
                 'code' => $data['code'],
                 'first_name' => $data['first_name'],
                 'last_name' => $data['last_name'],
                 'email' => $data['email'],
             ]);

    $this->assertDatabaseHas('employees', [
        'code' => $data['code'],
        'email' => $data['email'],
    ]);
});

it('can update an employee', function () {
    $employee = Employee::factory()->create();

    $data = [
        'code' => $employee->code,
        'first_name' => 'UpdatedFirst',
        'last_name' => 'UpdatedLast',
        'email' => $employee->email,
        'hire_date' => $employee->hire_date->format('Y-m-d'),
        'phone' => $employee->phone,
        'birth_date' => $employee->birth_date ? $employee->birth_date->format('Y-m-d') : null,
        'job_title' => $employee->job_title,
        'department' => $employee->department,
    ];

    $response = putJson("/api/employees/{$employee->id}", $data);

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'first_name' => 'UpdatedFirst',
                 'last_name' => 'UpdatedLast',
             ]);

    $this->assertDatabaseHas('employees', [
        'id' => $employee->id,
        'first_name' => 'UpdatedFirst',
        'last_name' => 'UpdatedLast',
    ]);
});

it('can delete an employee', function () {
    $employee = Employee::factory()->create();

    $response = deleteJson("/api/employees/{$employee->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('employees', [
        'id' => $employee->id,
    ]);
});
