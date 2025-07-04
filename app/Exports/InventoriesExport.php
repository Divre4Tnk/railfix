<?php

namespace App\Exports;

use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoriesExport implements FromView, WithEvents, WithStyles
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $query = Inventory::with('location');

        if ($this->start != null || $this->end != null) {
            $query->whereDate('date_in', '>=', $this->start)->whereDate('date_in', '<=', $this->end);
        }

        $query = $query->latest()->get();

        return view('inventory.export', [
            'inventories' => $query,
            'start' => $this->start ? Carbon::parse($this->start) : null,
            'end' => $this->end ? Carbon::parse($this->end) : null,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:A3')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center'
            ]
        ]);

        if ($this->start != null || $this->end != null) {
            $sheet->getStyle('A8:K8')->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ]
            ]);
        } else {
            $sheet->getStyle('A5:K5')->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center'
                ]
            ]);
        }

        return $sheet;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                foreach (range('A', 'K') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                if ($this->start !== null || $this->end !== null) {
                    $cellRange = 'A8:K' . $sheet->getHighestRow();
                } else {
                    $cellRange = 'A5:K' . $sheet->getHighestRow();
                }

                $sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ]
                ]);
            }
        ];
    }
}
