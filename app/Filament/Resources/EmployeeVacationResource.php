<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeVacationResource\Pages;
use App\Filament\Resources\EmployeeVacationResource\RelationManagers;
use App\Models\EmployeeVacation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class EmployeeVacationResource extends Resource
{
    protected static ?string $model = EmployeeVacation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('employee_id')
                ->relationship('employee', 'first_name')
                ->searchable()
                ->required(),

            TextInput::make('opening_vacations_count')
                ->numeric()
                ->required()
                ->minValue(0),

            TextInput::make('used_vacations_count')
                ->numeric()
                ->required()
                ->minValue(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.first_name')->label('الموظف'),
                TextColumn::make('opening_vacations_count')->label('الرصيد الافتتاحي'),
                TextColumn::make('used_vacations_count')->label('الرصيد المستخدم'),
                TextColumn::make('remaining_vacations')->label('الرصيد المتبقي')
                    ->getStateUsing(function ($record) {
                        return $record->opening_vacations_count - $record->used_vacations_count;
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployeeVacations::route('/'),
            'create' => Pages\CreateEmployeeVacation::route('/create'),
            'edit' => Pages\EditEmployeeVacation::route('/{record}/edit'),
        ];
    }
}
