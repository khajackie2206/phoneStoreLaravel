<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\Exportable;

class OrderExport implements FromCollection, WithHeadings, WithMapping, WithEvents

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
        return Order::select('id', 'user_id', 'payment_id', 'total', 'status_id', 'order_date', 'note', 'delivery_address')->get();
    }


    public function headings(): array
    {
        return [
            'ID',
            'Khách hàng',
            'Phương thức thanh toán',
            'Tổng hóa đơn',
            'Trạng thái đơn hàng',
            'Ngày đặt hàng',
            'Ghi chú',
            'Địa chỉ giao hàng'
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
                $size = sizeof(Order::all()) + 1;

                // $event->sheet->styleCells('B4:E4', $styleHeader);
                // $event->sheet->styleCells('B2:E', $styleFontTextAll);
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




                // // set height
                // $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(10);
                // $event->sheet->getDelegate()->getRowDimension('3')->setRowHeight(10);
                // $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(25);
            },
        ];
    }


    public function map($order): array
    {
        return [
            $order->id,
            $order->user->name,
            $order->payment->name,
            number_format($order->total) . ' VNĐ',
            $order->status->name,
            $order->order_date,
            $order->note,
            $order->delivery_address,
        ];
    }
}
