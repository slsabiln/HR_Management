<x-filament::page>
    <div class="space-y-6">
        <div class="flex space-x-4">
            <x-filament::input type="number" wire:model="year" placeholder="السنة" />
            <x-filament::input type="number" wire:model="month" min="1" max="12" placeholder="الشهر" />
        </div>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">الموظف</th>
                    <th class="border border-gray-300 px-4 py-2">الراتب الأساسي</th>
                    <th class="border border-gray-300 px-4 py-2">مجموع البدلات</th>
                    <th class="border border-gray-300 px-4 py-2">الراتب الصافي</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $item)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $item['employee'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($item['base_salary'], 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($item['allowances_total'], 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($item['net_salary'], 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">لا توجد بيانات لعرضها.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament::page>
