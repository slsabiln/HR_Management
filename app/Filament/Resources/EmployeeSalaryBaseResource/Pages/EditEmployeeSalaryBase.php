<?php

namespace App\Filament\Resources\EmployeeSalaryBaseResource\Pages;

use App\Filament\Resources\EmployeeSalaryBaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeSalaryBase extends EditRecord
{
    protected static string $resource = EmployeeSalaryBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
