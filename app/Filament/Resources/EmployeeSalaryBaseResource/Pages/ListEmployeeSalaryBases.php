<?php

namespace App\Filament\Resources\EmployeeSalaryBaseResource\Pages;

use App\Filament\Resources\EmployeeSalaryBaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeSalaryBases extends ListRecords
{
    protected static string $resource = EmployeeSalaryBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
