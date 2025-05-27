<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeVacation;
use Illuminate\Http\Request;

class EmployeeVacationController extends Controller
{
   public function index()
{
    return response()->json(['data' => EmployeeVacation::all()]);
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'opening_vacations_count' => 'required|integer|min:0',
            'used_vacations_count' => 'required|integer|min:0',
        ]);

        $vacation = EmployeeVacation::create($data);

        return response()->json($vacation, 201);
    }

    public function show(EmployeeVacation $employeeVacation)
    {
        return response()->json($employeeVacation);
    }

    public function update(Request $request, EmployeeVacation $employeeVacation)
    {
        $data = $request->validate([
            'opening_vacations_count' => 'required|integer|min:0',
            'used_vacations_count' => 'required|integer|min:0',
        ]);

        $employeeVacation->update($data);

        return response()->json($employeeVacation);
    }

    public function destroy(EmployeeVacation $employeeVacation)
    {
        $employeeVacation->delete();

        return response()->noContent();
    }
}
