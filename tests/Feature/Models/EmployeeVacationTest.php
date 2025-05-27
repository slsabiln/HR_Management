<?php
use App\Models\EmployeeVacation;


it('throws validation exception if vacation days are negative on create', function () {
    EmployeeVacation::create([
        'employee_id' => 1,
        'opening_vacations_count' => -5,
        'used_vacations_count' => 0,
    ]);
})->throws(Illuminate\Validation\ValidationException::class);

it('throws validation exception if vacation days are negative on update', function () {
    $vacation = EmployeeVacation::factory()->create([
        'opening_vacations_count' => 10,
        'used_vacations_count' => 0,
    ]);

    $vacation->update([
        'opening_vacations_count' => -3,
    ]);
})->throws(Illuminate\Validation\ValidationException::class);
