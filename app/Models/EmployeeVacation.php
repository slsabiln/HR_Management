<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EmployeeVacation extends Model
{
     use HasFactory;

    protected $table = 'employee_vacations';

    protected $fillable = [
        'employee_id',
        'opening_vacations_count',
        'used_vacations_count',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function boot()
    {
        parent::boot();

        // قبل إنشاء سجل جديد
        static::creating(function ($vacation) {
            if ($vacation->opening_vacations_count < 0 || $vacation->used_vacations_count < 0) {
                throw ValidationException::withMessages([
                    'vacations_count' => 'Vacation days cannot be negative.',
                ]);
            }
        });

        // قبل تحديث سجل موجود
        static::updating(function ($vacation) {
            if ($vacation->opening_vacations_count < 0 || $vacation->used_vacations_count < 0) {
                throw ValidationException::withMessages([
                    'vacations_count' => 'Vacation days cannot be negative.',
                ]);
            }
        });
    }
}
