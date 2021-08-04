<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\HomepageMail;
use App\Models\{
    User,
};
use App\Helpers\Converter;
use DateTime;
use DateTimeZone;

class EmailTesterController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(6);
        // $detail_mail = [
        //     'subject' => "Tester ke-4",
        //     'title' => "Withdrawal Request",
        //     'username' => $user->name,
        //     'message_bottom' => 'To see evidence of transfer, you can view it on the website. For security reasons, you must sign in first.',
        //     'codes' => [
        //         'type' => 'withdrawal',
        //         'code' => 'WTH21072021QWSZ5MFA'
        //     ],
        //     'bank_information' => [
        //         'bank_name' => 'BCA',
        //         'bank_account_name' => 'Mochamad Rizky',
        //         'bank_account_number' => Converter::numberFormattedAttribute(322479212218, 'x', 3, 3),
        //         'amount' => 590000,
        //     ],
        // ];
        $date_now = date_format(new DateTime("now", new DateTimeZone('Asia/Jakarta')), 'd F Y H:i:s');
        $detail_mail = [
            'subject' => "Tester",
            'title' => "ORDER TRANSACTION",
            'date' => "{$date_now}UTC+7",
            'codes' => [
                'type' => 'transaction',
                'code' => 'TRX20210416CS56190107',
            ],
            'username' => "Mochamad Rizky",
            'message' => 'thank you for ordering the <b>Technical Supports Fundamental</b> course provided by <b>Google</b>. Please complete your payment before due time.<br><br> You will receive email from <b>Midtrans <small>&lt;noreply@midtrans.com&gt;</small></b> for procedure of payment <b>or</b> click the button below to download pdf payment method.',
            'button_link' => [
                'url' => 'https://app.sandbox.midtrans.com/snap/v1/transactions/47e755db-0cd6-44fc-a409-a8a2cf9da953/pdf',
                'button_text' => 'Download',
                'with_text' => true,
            ]
        ];
        return view('mail.tester.email-tester')->with(['details' => $detail_mail]);
    }
    
    public function sendTester()
    {
        $user = User::findOrFail(6);
        $date_now = date_format(new DateTime("now", new DateTimeZone('Asia/Jakarta')), 'd F Y H:i:s');
        $detail_mail = [
            'subject' => "Tester Time [".date('H:i:s')."]",
            'title' => "ORDER TRANSACTION",
            'date' => "{$date_now}UTC+7",
            'codes' => [
                'type' => 'transaction',
                'code' => 'TRX20210416CS56190107',
            ],
            'username' => "Mochamad Rizky",
            'message' => 'thank you for ordering the <b>Technical Supports Fundamental</b> course provided by <b>Google</b>. Please complete your payment before due time.<br><br> You will receive email from <b>Midtrans <small>&lt;noreply@midtrans.com&gt;</small></b> for procedure of payment <b>or</b> click the button below to download pdf payment method.',
            'button_link' => [
                'url' => 'https://app.sandbox.midtrans.com/snap/v1/transactions/47e755db-0cd6-44fc-a409-a8a2cf9da953/pdf',
                'button_text' => 'Download',
                'with_text' => true,
            ]
        ];
        $homepage_mail = new HomepageMail($detail_mail);
        \Mail::to("s2.DanielAoki@gmail.com")->send($homepage_mail);

        return "success";
    }
}
