<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAllowance extends Model
{
    use SoftDeletes;

    protected $table = 'employee_allowances';

    protected $fillable = [
        'employee_id',
        'allowance_type',
        'amount',
        'start_date',
        'end_date',
       
    ];

   
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
