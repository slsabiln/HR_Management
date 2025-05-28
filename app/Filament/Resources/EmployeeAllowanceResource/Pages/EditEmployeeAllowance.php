<?php

namespace App\Filament\Resources\EmployeeAllowanceResource\Pages;

use App\Filament\Resources\EmployeeAllowanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeAllowance extends EditRecord
{
    protected static string $resource = EmployeeAllowanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
