<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // List all employees
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    // Store new employee
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:employees,code',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:50',
            'hire_date' => 'required|date',
            'birth_date' => 'nullable|date',
            'job_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);

        $employee = Employee::create($data);

        return response()->json($employee, 201);
    }

    // Show one employee
    public function show(Employee $employee)
    {
        return response()->json($employee, 200);
    }

    // Update employee
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'code' => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('employees')->ignore($employee->id)],
            'phone' => 'nullable|string|max:50',
            'hire_date' => 'required|date',
            'birth_date' => 'nullable|date',
            'job_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);

        $employee->update($data);

        return response()->json($employee, 200);
    }

    // Delete employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(null, 204);
    }

    public function search(Request $request)
{
    $search = $request->query('search');

    $employees = Employee::query()
        ->where('full_name', 'like', "%{$search}%")
        ->orWhere('code', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%")
        ->get();

    return response()->json(['data' => $employees]);
}

}
