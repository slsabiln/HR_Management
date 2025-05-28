<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeVacationController;
use App\Http\Controllers\Api\EmployeeAllowanceController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('employee-vacations', EmployeeVacationController::class);
Route::apiResource('employee-allowances', EmployeeAllowanceController::class);
