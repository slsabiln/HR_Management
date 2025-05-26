<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeVacation extends Model
{
    use SoftDeletes;

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
}
