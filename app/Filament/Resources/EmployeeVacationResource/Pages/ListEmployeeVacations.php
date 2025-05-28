<?php

namespace App\Filament\Resources\EmployeeVacationResource\Pages;

use App\Filament\Resources\EmployeeVacationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeVacations extends ListRecords
{
    protected static string $resource = EmployeeVacationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
