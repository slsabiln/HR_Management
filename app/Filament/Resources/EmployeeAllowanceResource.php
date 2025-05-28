<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeAllowanceResource\Pages;
use App\Filament\Resources\EmployeeAllowanceResource\RelationManagers;
use App\Models\EmployeeAllowance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\DateColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;


class EmployeeAllowanceResource extends Resource
{
    protected static ?string $model = EmployeeAllowance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form
        ->schema([
            Select::make('employee_id')
                ->relationship('employee', 'first_name') // عرض اسم الموظف
                ->searchable()
                ->required(),

            TextInput::make('type')
                ->label('نوع البدلة')
                ->required(),

            TextInput::make('amount')
                ->label('المبلغ')
                ->numeric()
                ->required(),

            DatePicker::make('start_date')
                ->label('تاريخ البداية')
                ->required(),

            DatePicker::make('end_date')
                ->label('تاريخ الانتهاء')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('employee.first_name')
                ->label('الموظف'),

            TextColumn::make('type')
                ->label('نوع البدلة'),

            TextColumn::make('amount')
                ->label('المبلغ'),

            TextColumn::make('start_date')
                ->label('تاريخ البداية')
                ->date('Y-m-d'), // تنسيق التاريخ

            TextColumn::make('end_date')
                ->label('تاريخ الانتهاء')
                ->date('Y-m-d'), // تنسيق التاريخ
        ])
         ->actions([
            EditAction::make(),
            DeleteAction::make(),
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
            'index' => Pages\ListEmployeeAllowances::route('/'),
            'create' => Pages\CreateEmployeeAllowance::route('/create'),
            'edit' => Pages\EditEmployeeAllowance::route('/{record}/edit'),
        ];
    }
}
