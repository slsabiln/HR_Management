<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        
    return $form
        ->schema([
            Forms\Components\TextInput::make('code')
                ->label('كود الموظف')
                ->required()
                ->unique(ignoreRecord:true)  // لتجنب الخطأ عند التعديل
                ->maxLength(255),

            Forms\Components\TextInput::make('first_name')
                ->label('الاسم الأول')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('last_name')
                ->label('اسم العائلة')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->label('البريد الإلكتروني')
                ->email()
                ->required()
                ->unique(ignoreRecord:true)
                ->maxLength(255),

            Forms\Components\TextInput::make('phone')
                ->label('رقم الهاتف')
                ->tel()
                ->maxLength(20)
                ->nullable(),

            Forms\Components\DatePicker::make('hire_date')
                ->label('تاريخ التوظيف')
                ->required(),

            Forms\Components\DatePicker::make('birth_date')
                ->label('تاريخ الميلاد')
                ->nullable(),

            Forms\Components\TextInput::make('job_title')
                ->label('المسمى الوظيفي')
                ->nullable()
                ->maxLength(255),

            Forms\Components\TextInput::make('department')
                ->label('القسم')
                ->nullable()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('code')
                ->label('كود الموظف')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('first_name')
                ->label('الاسم الأول')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('last_name')
                ->label('اسم العائلة')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->label('البريد الإلكتروني')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('phone')
                ->label('رقم الهاتف')
                ->sortable(),

            Tables\Columns\TextColumn::make('job_title')
                ->label('المسمى الوظيفي')
                ->sortable(),

            Tables\Columns\TextColumn::make('department')
                ->label('القسم')
                ->sortable(),

            Tables\Columns\TextColumn::make('hire_date')
                ->label('تاريخ التوظيف')
                ->date()
                ->sortable(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
