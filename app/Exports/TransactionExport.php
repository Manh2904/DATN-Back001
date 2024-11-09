<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings
{
    private $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        $transactions = $this->transactions;
        $formatTransaction = [];
        foreach ($transactions as $key => $item) {

            $formatTransaction[] = [
                'id' => $item->id,
                'total' => $item->tst_total_money,
                'name' => $item->tst_name,
                'email' => $item->tst_email,
                'phone' => $item->tst_phone,
                'address' => $item->tst_address,
                'status' => $item->getStatus($item->tst_status)['name'],
                'type' => $item->tst_user_id ? " Thành viên " : "Khách",
                'create' => $item->created_at
            ];
        }

        return collect($formatTransaction);
    }

    public function headings(): array
    {
        return [
            '#',
            'use_id',
            'Tổng tiền',
            'Tên khách hàng',
            'Email',
            'Số điện thoại',
            'Địa chỉ',
            'Note',
            'Trạng thái',
            'Thanh toán bằng',
            'Tạo lúc'
        ];
    }
}
