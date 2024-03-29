<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Course,
    CustomerTransaction,
    CustomerTransactionDetail,
};
use App\Mail\CustomerMail;
use App\Mail\HomepageMail;
use Mail;
use DateTime;
use DateTimeZone;

class PaymentController extends Controller
{
    public function index($slug_course_name)
    {
        
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $slug_course_name)
        ->firstOrFail();
        
        $popular_courses = Course::where([['is_published', '=', 1], ['user_id', '=', $course->user_id]])->inRandomOrder()->offset(0)->limit(10)->get();
        
        $data['course'] = $course;
        $data['courses'] = (object) ['popular_courses' => $popular_courses];
        // dd($data);
        return view('homepage.pages.payments.pay_course')->with($data);
    }
    
    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);
        
        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.server_key'));
        
        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }
        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');
        
        $paymentNotification = new \Midtrans\Notification();
        $customer_transaction = CustomerTransaction::select('users.name', 'users.email', 'customer_transactions.*')
        ->leftJoin('users', 'users.id', '=', 'customer_transactions.customer_id')
        ->where('transaction_code', $paymentNotification->order_id)->firstOrFail();
        // dd($detail_transaction, $customer_transaction);

        $course = Course::where('id', $customer_transaction->course_id)->first();
        
        $transaction = $paymentNotification->transaction_status;
        $type = $paymentNotification->payment_type;
        $orderId = $paymentNotification->order_id;
        $fraud = $paymentNotification->fraud_status;
        
        $vaNumber = null;
        $vendorName = null;
        if (!empty($paymentNotification->va_numbers[0])) {
            $vaNumber = $paymentNotification->va_numbers[0]->va_number;
            $vendorName = (strlen($paymentNotification->va_numbers[0]->bank) == 3)? \Str::upper($paymentNotification->va_numbers[0]->bank) : $paymentNotification->va_numbers[0]->bank;
        }
        
        $date_now = date_format(new DateTime("now", new DateTimeZone('Asia/Jakarta')), 'd F Y H:i:s');

        $detail_mail = [
            'subject' => "",
            'title' => "ORDER TRANSACTION",
            'date' => "{$date_now}UTC+7",
            'codes' => [
                'type' => 'transaction',
                'code' => $customer_transaction->transaction_code,
            ],
            'username' => $customer_transaction->name,
            'message' => '',
        ];
        //['waiting', 'pending', 'settlement', 'deny', 'expire', 'cancel']
        $paymentStatus = null;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    // $paymentStatus = Payment::CHALLENGE;
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    // $paymentStatus = Payment::SUCCESS;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $detail_mail['subject'] = "Thank you for your payment - ".config('app.name')." - {$customer_transaction->transaction_code}";
            $detail_mail['message'] = "Your transaction was successful! Thank you for ordering the <b>{$course->title}</b> course provided by <b>{$course->corporation->name}</b>.";
            $paymentStatus = 'settlement';
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $trx_detail = CustomerTransactionDetail::where('customer_transaction_id', $customer_transaction->id)->first();
            $detail_mail['subject'] = "Your payment process has not been completed - ".config('app.name')." - {$customer_transaction->transaction_code}";
            if($trx_detail) {
                $detail_mail['message'] = "thank you for ordering the <b>{$course->title}</b> course provided by <b>{$course->corporation->name}</b>. Please complete your payment before due time.<br><br> You will receive email from <b>Midtrans <small>&lt;noreply@midtrans.com&gt;</small></b> for procedure of payment <b>or</b> click the button below to download pdf payment method.";
                $detail_mail['button_link'] = [
                    'url' => $trx_detail->link_pdf_payment_method,
                    'button_text' => 'Download',
                    'with_text' => true,
                ];
            } else {
                $detail_mail['message'] = "thank you for ordering the <b>{$course->title}</b> course provided by <b>{$course->corporation->name}</b>. Please complete your payment before due time.<br><br> You will receive email from <b>Midtrans <small>&lt;noreply@midtrans.com&gt;</small></b> for procedure of payment.";
            }
            $paymentStatus = 'pending';
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $detail_mail['subject'] = "Your payment process has been declined - ".config('app.name')." - {$customer_transaction->transaction_code}";
            $paymentStatus = 'deny';
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $detail_mail['subject'] = "Your payment process has been declined - ".config('app.name')." - {$customer_transaction->transaction_code}";
            $paymentStatus = 'expire';
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $detail_mail['subject'] = "Your payment process has been canceled - ".config('app.name')." - {$customer_transaction->transaction_code}";
            $detail_mail['message'] = "Your order has been canceled by ".config('app.name').". Please contact ".config('app.name')." if you have any questions regarding your order.";
            $paymentStatus = 'cancel';
        }
        
        if ($paymentStatus) {
			\DB::transaction(
				function () use ($customer_transaction, $paymentNotification, $vendorName, $vaNumber, $paymentStatus) {
                    $customer_transaction->status_payment = $paymentStatus;
                    $customer_transaction->save();
                    $detail_transaction = CustomerTransactionDetail::firstOrCreate(
                        ['customer_transaction_id' => $customer_transaction->id],
                        [
                            'customer_id' => $customer_transaction->customer_id,
                            'midtrans_transaction_id' => $paymentNotification->transaction_id,
                            'order_id' => $customer_transaction->transaction_code,
                            'total_amount' => $paymentNotification->gross_amount,
                            'payment_type' => $paymentNotification->payment_type,
                            'bank' => $vendorName,
                            'va_number' => $vaNumber,
                            'bill_key' => $paymentNotification->bill_key,
                            'biller_code' => $paymentNotification->biller_code,
                            'payment_code' => $paymentNotification->payment_type,
                            'transaction_status' => 'waiting',
                        ]
                    );
                    $detail_transaction->transaction_status = $paymentStatus;
                    $detail_transaction->save();
				}
			);
		}

        $homepage_mail = new HomepageMail($detail_mail);
        \Mail::to($customer_transaction->email)->send($homepage_mail);
        // $customer_mail = new CustomerMail($detail_mail);
        // \Mail::to($customer_transaction->email)->send($customer_mail);

        $message = 'Payment status is : '. $paymentStatus;

		$response = [
			'code' => 200,
			'message' => $message,
		];

		return response($response, 200);
    }

    public function completed(Request $request)
    {
        $code = $request->query('order_id');
		$customer_transaction = CustomerTransaction::select('courses.title', 'customer_transactions.*')
        ->join('courses', 'courses.id', '=', 'customer_transactions.course_id')
        ->where('transaction_code', $code)->firstOrFail();
		
		if ($customer_transaction->payment_status != "settlement") {
			return redirect('payments/failed?order_id='. $code);
		}

		\Session::flash('success', "Thank you for completing the payment process!");
        
		return redirect()->route('home.course.enroll', ['title' => \Str::slug($customer_transaction->title)]);
    }

    public function unfinish(Request $request)
    {
        $code = $request->query('order_id');
		$customer_transaction = CustomerTransaction::select('courses.title', 'customer_transactions.*')
        ->join('courses', 'courses.id', '=', 'customer_transactions.course_id')
        ->where('transaction_code', $code)->firstOrFail();

		\Session::flash('error', "Sorry, we couldn't process your payment.");

		return redirect()->route('home.course.enroll', ['title' => \Str::slug($customer_transaction->title)]);
    }

    public function failed(Request $request)
    {
        $code = $request->query('order_id');
		$customer_transaction = CustomerTransaction::select('courses.title', 'customer_transactions.*')
        ->join('courses', 'courses.id', '=', 'customer_transactions.course_id')
        ->where('transaction_code', $code)->firstOrFail();

		\Session::flash('error', "Sorry, we couldn't process your payment.");

		return redirect()->route('home.course.enroll', ['title' => \Str::slug($customer_transaction->title)]);
    }
}
