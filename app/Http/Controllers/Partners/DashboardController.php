<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    PartnerFundTransaction as FundTransaction,
    PartnerWithDrawal,
};
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $first_date = date('Y-m-1 00:00:00');
        $last_date = date('Y-m-t 23:59:59');
        $sales_graph = FundTransaction::select(DB::raw('SUM(amount) as total_amount, DATE_FORMAT(created_at, "%d %M") as date'))
        ->whereBetween('created_at', [$first_date, $last_date])
        ->where('partner_id', Auth('partner')->user()->id)
        ->groupBy('date')
        ->get();
        $total_amount = $sales_graph->sum("total_amount");
        $list_amount = [];
        $list_date = [];
        foreach ($sales_graph as $key => $value) {
            $list_amount[$key] = (int) $value->total_amount;
            $list_date[$key] = $value->date;
        }
        // dump($first_date);
        // dump($last_date);
        // dump($total_amount);
        // dump($list_amount);
        // dump($list_date);
        // dd($sales_graph->toArray());
        return view('partners.index', compact('first_date', 'last_date', 'total_amount', 'list_amount', 'list_date'));
    }
}
