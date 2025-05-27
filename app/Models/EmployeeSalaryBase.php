<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSalaryBase extends Model
{
    use HasFactory;

    protected $table = 'employee_salary_base';

    protected $fillable = [
        'employee_id',
        'amount',
        'year',
        'month',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            // تحقق إذا يوجد سجل بنفس الموظف والسنة والشهر
            $exists = self::where('employee_id', $model->employee_id)
                ->where('year', $model->year)
                ->where('month', $model->month)
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'month' => ['Duplicate salary base for the same employee in the same month and year.'],
                ]);
            }
        });

    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
