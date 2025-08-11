<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExport implements FromView, ShouldAutoSize, WithTitle, WithEvents, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Order::with(['customer', 'shop']);

        // Filter status
        if ($this->request->filled('status') && $this->request->status != 'all') {
            $query->where('payment_status', $this->request->status);
        }

        // Filter tanggal
        if ($this->request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $this->request->start_date);
        }
        if ($this->request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $this->request->end_date);
        }

        // Filter shop
        if ($this->request->filled('shop_id') && $this->request->shop_id != 'all') {
            $query->where('shop_id', $this->request->shop_id);
        }

        $orders = $query->get();
        $totalGrand = $orders->sum('grand_total');

        return view('admin.reports.exports.orders_excel', [
            'orders'      => $orders,
            'totalGrand'  => $totalGrand
        ]);
    }

    public function title(): string
    {
        return 'Orders Report';
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Header row (baris pertama)
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCCE5FF'], // Light blue
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $ordersCount = Order::count(); // Atau gunakan count dari $orders jika mau lebih akurat
                $lastRow = $ordersCount + 2;

                // Tambahkan border ke semua cell yang terisi
                $sheet->getStyle('A1:G' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Set lebar kolom manual jika tidak pakai ShouldAutoSize
                $sheet->getColumnDimension('A')->setWidth(5);  // No
                $sheet->getColumnDimension('B')->setWidth(20); // Invoice
                $sheet->getColumnDimension('C')->setWidth(15); // Tanggal
                $sheet->getColumnDimension('D')->setWidth(20); // Pelanggan
                $sheet->getColumnDimension('E')->setWidth(20); // Toko
                $sheet->getColumnDimension('F')->setWidth(15); // Status
                $sheet->getColumnDimension('G')->setWidth(25); // Total
            },
        ];
    }
}
