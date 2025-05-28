<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeSalaryResource\Pages;
use App\Filament\Resources\EmployeeSalaryResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use App\Models\EmployeeSalaryBase as EmployeeSalary;

class EmployeeSalaryResource extends Resource
{
    protected static ?string $model = EmployeeSalary::class;

       protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // ✅ هذا السطر يحدد عنوان المورد في الشريط الجانبي
    protected static ?string $navigationLabel = 'رواتب الموظفين';

    // ✅ هذا السطر لتجميع الموارد تحت قسم مشترك في الـ Sidebar
    protected static ?string $navigationGroup = 'المالية';

    // ✅ هذا السطر يعطي ترتيب الظهور في الشريط الجانبي
    protected static ?int $navigationSort = 1;

    // ✅ تأكدي أن هذا غير موجود أو أنه = true
    protected static bool $shouldRegisterNavigation = true;
    public static function form(Form $form): Form
    {
       return $form
        ->schema([
            Forms\Components\Select::make('employee_id')
                ->label('الموظف')
                ->relationship('employee', 'first_name')
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('year')
                ->numeric()
                ->default(date('Y'))
                ->required(),

            Forms\Components\TextInput::make('month')
                ->numeric()
                ->default(date('n'))
                ->minValue(1)
                ->maxValue(12)
                ->required(),

            Forms\Components\TextInput::make('amount')
                ->label('الراتب الأساسي')
                ->numeric()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('employee.full_name')
                ->label('الموظف'),

            TextColumn::make('year')
                ->label('السنة'),

            TextColumn::make('month')
                ->label('الشهر'),

            TextColumn::make('amount')
                ->label('الراتب الأساسي')
                ->money('SAR'),

            TextColumn::make('employee')
                ->label('مجموع البدلات')
                ->formatStateUsing(function ($record) {
                    return number_format($record->employee->allowances()
                        ->whereYear('start_date', $record->year)
                        ->whereMonth('start_date', $record->month)
                        ->sum('amount'), 2);
                }),

            TextColumn::make('employee')
                ->label('الراتب الصافي')
                ->formatStateUsing(function ($record) {
                    $allowances = $record->employee->allowances()
                        ->whereYear('start_date', $record->year)
                        ->whereMonth('start_date', $record->month)
                        ->sum('amount');
                    return number_format($record->amount + $allowances, 2);
                }),
        ])
        ->filters([])
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
            'index' => Pages\ListEmployeeSalaries::route('/'),
            'create' => Pages\CreateEmployeeSalary::route('/create'),
            'edit' => Pages\EditEmployeeSalary::route('/{record}/edit'),
        ];
    }
}
