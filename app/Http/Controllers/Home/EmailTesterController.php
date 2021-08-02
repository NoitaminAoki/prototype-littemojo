<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\HomepageMail;

class EmailTesterController extends Controller
{
    public function index()
    {
        return view('mail.tester.email-tester');
    }
    
    public function sendTester()
    {
        $detail_mail = [
            'subject' => "Tester ke-3",
            'body' => ""
        ];
        $homepage_mail = new HomepageMail($detail_mail);
        \Mail::to("s2.DanielAoki@gmail.com")->send($homepage_mail);

        return "success";
    }
}
