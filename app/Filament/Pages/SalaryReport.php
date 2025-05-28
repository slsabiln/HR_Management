<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Employee;
use Illuminate\Contracts\View\View;

class SalaryReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.salary-report';

    public $year;
    public $month;

    public $results = [];

    public function mount()
    {
        // تعيين السنة والشهر الحاليين كبداية
        $this->year = date('Y');
        $this->month = date('n');
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['year', 'month'])) {
            $this->calculateSalaries();
        }
    }

    public function calculateSalaries()
    {
        $this->results = [];

        $employees = Employee::with(['salaryBases', 'allowances'])->get();

        foreach ($employees as $employee) {
            $salaryData = $employee->getSalaryForMonth($this->year, $this->month);

            if (
                is_array($salaryData)
                && isset($salaryData['base_salary'], $salaryData['allowances_total'], $salaryData['net_salary'])
            ) {

                $this->results[] = [
                    'employee' => $employee->first_name . ' ' . $employee->last_name,
                    'base_salary' => $salaryData['base_salary'],
                    'allowances_total' => $salaryData['allowances_total'],
                    'net_salary' => $salaryData['net_salary'],
                ];
            }
        }
    }

    public function render(): View
    {
        $this->calculateSalaries();

        return view('filament.pages.salary-report');
    }

    protected static ?string $navigationGroup = 'التقارير';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'تقرير الرواتب';
}
