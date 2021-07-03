<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    PartnerFundTransaction as FundTransaction,
    PartnerWithdrawal,
};

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = PartnerWithdrawal::select('*')
        ->selectRaw("CASE status
        WHEN 'pending' THEN 0
        WHEN 'process' THEN 1
        WHEN 'success' THEN 2
        END as status_number")
        ->where('partner_id', Auth('partner')->user()->id)
        ->get();
        // dd($withdrawals);
        $data['withdrawals'] = [];
        return view('partners.withdrawal.index')->with($data);
    }

    public function image($uuid)
    {
        $file = PartnerWithdrawal::where('uuid', $uuid)->firstOrFail();
        $path = storage_path('app/'.$file->path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Cache-Control' => 'no-cache, no-store, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => '0', 'Content-Type' =>'image'));
            
        }
        
        abort(404);
    }
}
