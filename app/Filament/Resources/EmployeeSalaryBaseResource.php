<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeSalaryBaseResource\Pages;
use App\Filament\Resources\EmployeeSalaryBaseResource\RelationManagers;
use App\Models\EmployeeSalaryBase;
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

class EmployeeSalaryBaseResource extends Resource
{
    protected static ?string $model = EmployeeSalaryBase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form
        ->schema([
            Select::make('employee_id')
                ->label('الموظف')
                ->relationship('employee', 'first_name') // أو full_name لو موجودة
                ->searchable()
                ->required(),
            TextInput::make('amount')
                ->label('الراتب الأساسي')
                ->numeric()
                ->required(),
            TextInput::make('year')
                ->label('السنة')
                ->numeric()
                ->required(),
            TextInput::make('month')
                ->label('الشهر')
                ->numeric()
                ->minValue(1)
                ->maxValue(12)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('employee.first_name')->label('الموظف'),
            TextColumn::make('amount')->label('الراتب الأساسي'),
            TextColumn::make('year')->label('السنة'),
            TextColumn::make('month')->label('الشهر'),
            TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEmployeeSalaryBases::route('/'),
            'create' => Pages\CreateEmployeeSalaryBase::route('/create'),
            'edit' => Pages\EditEmployeeSalaryBase::route('/{record}/edit'),
        ];
    }
}
