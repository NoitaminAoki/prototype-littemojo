<?php

namespace App\Http\Controllers\Partners;

use App\Exports\Partners\TransactionExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = CustomerTransaction::leftJoin('courses', 'courses.id', 'customer_transactions.course_id')
        ->leftJoin('users', 'users.id', 'customer_transactions.customer_id')
        ->select('customer_transactions.id', 'customer_transactions.customer_id', 'customer_transactions.course_id', 'customer_transactions.price', 'customer_transactions.status_payment', 'customer_transactions.created_at', 'courses.title as title_course', 'users.name as name_customer')
        ->where('courses.user_id', Auth('partner')->user()->id)
        ->orderBy('customer_transactions.created_at', 'DESC')
        ->get();
        return view('partners.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPdf($status)
    {
        $transactions = CustomerTransaction::leftJoin('courses', 'courses.id', 'customer_transactions.course_id')
        ->when($status == 'Paid', function($q, $status){
            return $q->where('status_payment', 'settlement');
        })
        ->leftJoin('users', 'users.id', 'customer_transactions.customer_id')
        ->select('customer_transactions.id', 'customer_transactions.customer_id', 'customer_transactions.course_id', 'customer_transactions.price', 'customer_transactions.status_payment', 'customer_transactions.start_date', 'courses.title as title_course', 'users.name as name_customer')
        ->where('courses.user_id', Auth('partner')->user()->id)
        ->orderBy('customer_transactions.created_at', 'DESC')
        ->get();

        $pdf = \PDF::loadview('partners.transaction.transaction_pdf',['transactions'=>$transactions]);
        return $pdf->download(date('d-M-Y').'-transaction.pdf');
    }

    public function exportExcel($status){
        return \Excel::download(new TransactionExport($status), 'transaction.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
