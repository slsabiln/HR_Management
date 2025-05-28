<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Validation\ValidationException;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'hire_date',
        'birth_date',
        'job_title',
        'department',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'birth_date' => 'date',
    ];
    protected static function booted()
    {
        static::saving(function ($employee) {
            // تحقق من أن الكود فريد (ليس موجود في موظف آخر)
            $exists = self::where('code', $employee->code)
                ->where('id', '!=', $employee->id ?? 0)
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'code' => 'This employee code is already taken.',
                ]);
            }
        });
    }
    public function vacations(): HasMany
    {
        return $this->hasMany(EmployeeVacation::class);
    }


    public function allowances(): HasMany
    {
        return $this->hasMany(EmployeeAllowance::class);
    }


    public function salaryBases(): HasMany
    {
        return $this->hasMany(EmployeeSalaryBase::class);
    }

    public function managers()
    {
        return $this->belongsToMany(Employee::class, 'employees_managers', 'employee_id', 'manager_id');
    }

    public function addedRecord()
    {
        return $this->hasOne(EmployeeAdded::class);
    }

    public function additions()
    {
        return $this->hasMany(EmployeeAddition::class);
    }
}
