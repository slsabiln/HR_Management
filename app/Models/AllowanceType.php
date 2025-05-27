<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function employeeAllowances()
    {
        return $this->hasMany(EmployeeAllowance::class);
    }
}

