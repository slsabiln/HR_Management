<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EmployeeAllowance extends Model
{
    use HasFactory;

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

    public function allowanceType()
{
    return $this->belongsTo(AllowanceType::class);
}

}
