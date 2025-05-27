<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAllowance;
use Illuminate\Http\Request;

class EmployeeAllowanceController extends Controller
{
    public function index()
{
    return response()->json(['data' => EmployeeAllowance::all()]);
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $allowance = EmployeeAllowance::create($data);

        return response()->json($allowance, 201);
    }

    public function show(EmployeeAllowance $employeeAllowance)
    {
        return response()->json($employeeAllowance);
    }

    public function update(Request $request, EmployeeAllowance $employeeAllowance)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $employeeAllowance->update($data);

        return response()->json($employeeAllowance);
    }

    public function destroy(EmployeeAllowance $employeeAllowance)
    {
        $employeeAllowance->delete();

        return response()->noContent();
    }
}
