<?php

namespace App\Exports;

use App\Models\WarehouseReceipt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class WarehouseReceiptExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    private $headers = [
      'Content-Type' => 'text/csv',
    ];

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return WarehouseReceipt::select('id', 'staff_id', 'total', 'created_at', 'confirmed_date', 'status', 'supplier_id', 'note')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nhân viên nhập kho',
            'Tổng tiền',
            'Ngày tạo phiếu nhập',
            'Ngày xác nhận',
            'Trạng thái phiếu nhập',
            'Nhà cung cấp',
            'Ghi chú'
        ];
    }

    public function registerEvents(): array
    {
        $styleHeader = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'ffcc99'],
            ],
        ];

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'font' => [
                'bold'      =>  true
            ],
        ];


        $styleNormal = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        return [
            AfterSheet::class => function (AfterSheet $event) use (
                $styleNormal,
                $styleHeader,
                $styleArray
            ) {
                $size = sizeof(WarehouseReceipt::all()) + 1;

                $event->sheet->getDelegate()->getStyle('A1:H1')->applyFromArray($styleArray, $styleHeader);
                $event->sheet->getDelegate()->getStyle('A2:H' . $size)->applyFromArray($styleNormal);

                // set width
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(40);
            },
        ];
    }

    public function map($warehouseReceipt): array
    {
        return [
            $warehouseReceipt->id,
            $warehouseReceipt->admin->name,
            number_format($warehouseReceipt->total) . ' VNĐ',
            $warehouseReceipt->created_at,
            $warehouseReceipt->confirmed_date,
            $warehouseReceipt->status == 0 ? 'Chờ xác nhận' : 'Đã nhập kho',
            $warehouseReceipt->supplier->name,
            $warehouseReceipt->note,
        ];
    }
}
