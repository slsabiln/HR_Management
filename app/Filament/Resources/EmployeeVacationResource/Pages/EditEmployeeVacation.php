<?php

namespace App\Filament\Resources\EmployeeVacationResource\Pages;

use App\Filament\Resources\EmployeeVacationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeVacation extends EditRecord
{
    protected static string $resource = EmployeeVacationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
