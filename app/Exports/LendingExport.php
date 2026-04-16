<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LendingExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function collection()
    {
        $query = Lending::with('item');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [
                $this->startDate,
                $this->endDate
            ]);
        }

        return $query->get()->map(function ($lending) {
            return [
                'Item' => $lending->item->name ?? '-',
                'Total' => $lending->total,
                'Name' => $lending->name,
                'Ket' => $lending->ket ?? '-',
                'Date' => $lending->created_at->format('d M Y'),
                'Return Date' => $lending->return_date
                    ? \Carbon\Carbon::parse($lending->return_date)->format('d M Y')
                    : 'Belum dikembalikan',
            ];
        });
    }

    public function headings(): array
    {
        return ['Item', 'Total', 'Name', 'Ket', 'Date', 'Return Date'];
    }
}