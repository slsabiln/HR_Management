<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeAdded extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'note',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
