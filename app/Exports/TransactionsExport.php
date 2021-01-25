<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromCollection, WithMapping, WithHeadings, WithProperties, WithStyles, ShouldAutoSize
{
    public function __construct($transactions) {
      $this->transactions = $transactions;
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Roma Top',
            'title'          => 'Laporan Transaksi Roma Top',
            'description'    => 'Roma Top',
            'company'        => 'Roma Top',
            'total'        => count($this->transactions),
        ];
    }

    public function collection()
    {
        return $this->transactions;
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->created_at,
            $transaction->customer->name,
            $transaction->total_capital_price(),
            $transaction->total_selling_price(),
            $transaction->total_discount(),
            $transaction->total_price(),
            $transaction->total_paid,
            $transaction->change(),
        ];
    }
    
    public function headings(): array
    {
        return [
          'No Nota.',
          'Tgl.',
          'Nama Plgn.',
          'Total Hrg. Modal',
          'Total Hrg. Jual',
          'Total Diskon',
          'Total Transaksi',
          'Total Bayar',
          'Kembalian',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
