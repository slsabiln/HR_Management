<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Employee extends Model
{
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
}
