<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSalaryBase extends Model
{
    use SoftDeletes;

    protected $table = 'employee_salary_bases';

    protected $fillable = [
        'employee_id',
        'amount',
        'year',
        'month',
      
    ];

    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
