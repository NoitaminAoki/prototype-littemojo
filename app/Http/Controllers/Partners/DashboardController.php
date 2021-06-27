<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    PartnerFundTransaction as FundTransaction,
    PartnerWithdrawal,
    CustomerTransaction
};
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // date_default_timezone_set('Asia/Jakarta');
        $first_date = date('Y-m-1 00:00:00');
        $last_date = date('Y-m-t 23:59:59');
        $sales_graph = FundTransaction::select(DB::raw('SUM(partner_fund_transactions.amount) as total_amount, DATE_FORMAT(partner_fund_transactions.created_at, "%d %M") as date'))
        ->leftJoin('customer_transactions as ct', 'ct.id', 'partner_fund_transactions.customer_transaction_id')
        ->whereBetween('partner_fund_transactions.created_at', [$first_date, $last_date])
        ->where([['partner_fund_transactions.partner_id', Auth('partner')->user()->id], ['partner_fund_transactions.type_transaction', 'income'], ['ct.status_payment', 'settlement']])
        ->groupBy('date')
        ->get();
        $total_sales_amount = FundTransaction::select(DB::raw('SUM(amount) as total_amount'))
        ->leftJoin('customer_transactions as ct', 'ct.id', 'partner_fund_transactions.customer_transaction_id')
        ->where([['partner_id', Auth('partner')->user()->id], ['type_transaction', 'income'], ['ct.status_payment', 'settlement']])
        ->value('total_amount');
        $total_amount = $sales_graph->sum("total_amount");
        $list_amount = [];
        $list_date = [];
        foreach ($sales_graph as $key => $value) {
            $list_amount[$key] = (int) $value->total_amount;
            $list_date[$key] = $value->date;
        }

        if($sales_graph->isEmpty()) {
            $list_amount = [0, 0];
            $list_date = [Date('d F'), Date('t F')];
        }
        $sales = CustomerTransaction::where('status_payment', 'settlement')->count();
        return view('partners.index', compact('first_date', 'sales', 'last_date', 'total_sales_amount', 'total_amount', 'list_amount', 'list_date'));
    }
}
