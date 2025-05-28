<?php

namespace App\Filament\Resources\EmployeeSalaryBaseResource\Pages;

use App\Filament\Resources\EmployeeSalaryBaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployeeSalaryBase extends CreateRecord
{
    protected static string $resource = EmployeeSalaryBaseResource::class;
}
