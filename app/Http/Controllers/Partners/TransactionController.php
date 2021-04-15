<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CustomerTransaction;

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
        ->select('customer_transactions.id', 'customer_transactions.customer_id', 'customer_transactions.course_id', 'customer_transactions.price', 'customer_transactions.status_payment', 'customer_transactions.start_date', 'courses.title as title_course', 'users.name as name_customer')
        ->orderBy('customer_transactions.created_at', 'DESC')
        ->get();
        return view('partners.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
