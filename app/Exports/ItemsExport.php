<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Item::with(['category', 'lendings'])->get()->map(function ($item) {

            // total lending yang belum returned
            $lendingTotal = $item->lendings
                ->whereNull('return_date')
                ->sum('total');

            return [
                'Category' => $item->category->name ?? '-',
                'Name Item' => $item->name,
                'Total' => $item->total,

                // repair
                'Repair Total' => $item->repair > 0 ? $item->repair : '-',

                // lending
                'Lending Total' => $lendingTotal > 0 ? $lendingTotal : '-',

                // last updated
                'Last Updated' => $item->updated_at != $item->created_at
                    ? $item->updated_at->format('d M Y H:i')
                    : 'Belum ada update',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Category',
            'Name Item',
            'Total',
            'Repair Total',
            'Lending Total',
            'Last Updated',
        ];
    }
}