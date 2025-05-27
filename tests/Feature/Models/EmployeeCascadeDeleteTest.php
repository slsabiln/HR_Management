<?php

use App\Models\Employee;
use App\Models\EmployeeVacation;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeSalaryBase;

it('deletes all related records when an employee is deleted', function () {
    $employee = Employee::factory()->create();

    // إنشاء سجلات مرتبطة
    EmployeeVacation::factory()->create(['employee_id' => $employee->id]);
    EmployeeAllowance::factory()->create(['employee_id' => $employee->id]);
    EmployeeSalaryBase::factory()->create(['employee_id' => $employee->id]);

    // تأكد السجلات موجودة قبل الحذف
    expect(EmployeeVacation::where('employee_id', $employee->id)->count())->toBe(1);
    expect(EmployeeAllowance::where('employee_id', $employee->id)->count())->toBe(1);
    expect(EmployeeSalaryBase::where('employee_id', $employee->id)->count())->toBe(1);

    // حذف الموظف
    $employee->delete();

    // تحقق أن السجلات المرتبطة حذفوا
    expect(EmployeeVacation::where('employee_id', $employee->id)->count())->toBe(0);
    expect(EmployeeAllowance::where('employee_id', $employee->id)->count())->toBe(0);
    expect(EmployeeSalaryBase::where('employee_id', $employee->id)->count())->toBe(0);
});
