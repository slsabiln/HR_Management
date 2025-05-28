<?php

use App\Models\Employee;
use function Pest\Laravel\getJson;

it('can search employees by first_name or last_name', function () {
    $employee = Employee::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'code' => 'EMP001',
        'email' => 'johndoe@example.com',
    ]);

    Employee::factory()->create([
        'first_name' => 'Alice',
        'last_name' => 'Smith',
        'code' => 'EMP002',
        'email' => 'alice@example.com',
    ]);

    Employee::factory()->create([
        'first_name' => 'Bob',
        'last_name' => 'Brown',
        'code' => 'EMP003',
        'email' => 'bob@example.com',
    ]);

    Employee::factory()->create([
        'first_name' => 'Charlie',
        'last_name' => 'White',
        'code' => 'EMP004',
        'email' => 'charlie@example.com',
    ]);

    $response = $this->getJson('/api/employees/search?query=John');
    $response->assertOk()
        ->assertJsonFragment(['first_name' => 'John'])
        ->assertJsonCount(1, 'data');

    $response = $this->getJson('/api/employees/search?query=Doe');
    $response->assertOk()
        ->assertJsonFragment(['last_name' => 'Doe'])
        ->assertJsonCount(1, 'data');
});

it('can search employees by code', function () {
    $employee = Employee::factory()->create([
        'code' => 'EMP12345',
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test1@example.com',
    ]);

    Employee::factory()->create([
        'code' => 'EMP54321',
        'first_name' => 'Other',
        'last_name' => 'User',
        'email' => 'test2@example.com',
    ]);

    $response = $this->getJson('/api/employees/search?query=EMP12345');

    $response->assertOk()
        ->assertJsonFragment(['code' => 'EMP12345'])
        ->assertJsonCount(1, 'data');
});

it('can search employees by email', function () {
    $employee = Employee::factory()->create([
        'email' => 'johndoe@example.com',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'code' => 'EMP9876',
    ]);

    Employee::factory()->create([
        'email' => 'another@example.com',
        'first_name' => 'Someone',
        'last_name' => 'Else',
        'code' => 'EMP1234',
    ]);

    $response = $this->getJson('/api/employees/search?query=johndoe@example.com');

    $response->assertOk()
        ->assertJsonFragment(['email' => 'johndoe@example.com'])
        ->assertJsonCount(1, 'data');
});

it('returns empty array if query is missing', function () {
    Employee::factory()->count(3)->sequence(
        ['first_name' => 'A', 'code' => 'A001', 'email' => 'a@example.com'],
        ['first_name' => 'B', 'code' => 'B002', 'email' => 'b@example.com'],
        ['first_name' => 'C', 'code' => 'C003', 'email' => 'c@example.com'],
    )->create();

    $response = getJson('/api/employees/search');

    $response->assertOk()
        ->assertJson(['data' => []]);
});
