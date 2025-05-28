<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\EmployeeSalaryBase;
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
        $query = $request->input('query');

        // لو ما في كلمة بحث رجع الكل أو صفراً
        if (!$query) {
            return response()->json(['data' => []], 200);
        }

        $employees = Employee::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        return response()->json(['data' => $employees], 200);
    }


   public function salary(Employee $employee, Request $request)
{
    // السنة والشهر الحالي (تقدر تغيرهم حسب متطلباتك)
    $year = now()->year;
    $month = now()->month;

    // جلب الراتب الأساسي من جدول employee_salary_base
    $baseSalaryRecord = EmployeeSalaryBase::where('employee_id', $employee->id)
        ->where('year', $year)
        ->where('month', $month)
        ->first();

    $base_salary = $baseSalaryRecord ? $baseSalaryRecord->amount : 0;

    // جلب مجموع البدلات (Allowances)
    $total_allowances = $employee->allowances()->sum('amount');

    // جلب مجموع الإضافات (Additions) من جدول employee_additions
    $total_additions = $employee->additions()->sum('amount');

    // حساب الراتب الكلي
    $total_salary = $base_salary + $total_allowances + $total_additions;

    return response()->json([
        'base_salary' => $base_salary,
        'total_allowances' => $total_allowances,
        'total_additions' => $total_additions,
        'total_salary' => $total_salary,
    ]);
}

}
