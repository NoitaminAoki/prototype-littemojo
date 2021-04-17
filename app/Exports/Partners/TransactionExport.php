<?php

namespace App\Exports\Partners;

use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, ShouldAutoSize, WithEvents};
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\CustomerTransaction;

class TransactionExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($status) {
        $this->status = $status;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
            },
        ];
    }


    public function headings(): array
    {
        return [
            'Customer Name',
            'Course Title',
            'Price',
            'Status',
            'Start Date'
        ];
    }

    public function collection()
    {
        return CustomerTransaction::leftJoin('courses', 'courses.id', 'customer_transactions.course_id')
        ->when($this->status == 'Paid', function($q, $status){
            return $q->where('status_payment', 'settlement');
        })
        ->leftJoin('users', 'users.id', 'customer_transactions.customer_id')
        ->select('users.name as name_customer', 'courses.title as title_course', 'customer_transactions.price', 'customer_transactions.status_payment', 'customer_transactions.start_date')
        ->orderBy('customer_transactions.created_at', 'DESC')
        ->get();
    }
}
