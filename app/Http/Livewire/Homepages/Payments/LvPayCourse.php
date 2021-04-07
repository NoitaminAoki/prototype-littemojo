<?php

namespace App\Http\Livewire\Homepages\Payments;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\{
    Course,
    CustomerTransaction,
};

class LvPayCourse extends Component
{
    protected $listeners = [
        'evSnapResult' => 'snapResult',
    ];

    public $slug_course_name;
    public $snap_token;
    public $start_date;

    public $result_snap = [
        'is_open' => false,
        'order_id' => '',
        'total_amount' => 0,
        'payment_type' => '',
        'payment_type_readable' => '',
        'va_bank' => [
            'bank' => '',
            'va_number' => '',
        ],
        'echannel' => [
            'bank' => '',
            'bill_key' => '',
            'biller_code' => '',
        ],
        'cstore' => [
            'payment_code' => '',
        ],
        'pdf_payment_method' => ''
    ];

    public function mount($title)
    {
        $this->slug_course_name  = $title;
    }

    public function render()
    {
        $this->start_date = date('d F Y H:i');
        $course = Course::select('courses.*', 'catalog_topics.name as catalog_topic_title', 'catalogs.name as catalog_title', 'levels.name as level_name', 'levels.description as level_desc')
        ->leftJoin('catalogs', 'catalogs.id', 'courses.catalog_id')
        ->leftJoin('catalog_topics', 'catalog_topics.id', 'courses.catalog_topic_id')
        ->leftJoin('levels', 'levels.id', 'courses.level_id')
        ->where('slug_title', $this->slug_course_name)
        ->firstOrFail();
        
        $popular_courses = Course::where([['is_published', '=', 1], ['user_id', '=', $course->user_id]])->inRandomOrder()->offset(0)->limit(10)->get();
        
        $data['course'] = $course;
        $data['courses'] = (object) ['popular_courses' => $popular_courses];

        return view('homepage.pages.payments.lv-pay_course')
        ->with($data)
        ->layout('homepage.lv-layouts.lv-main');
    }

    public function pay()
    {
        $user_auth = Auth::guard('web')->user();
        $course = Course::select('*')
        ->where('slug_title', $this->slug_course_name)
        ->firstOrFail();
        $unpaid_transaction = CustomerTransaction::where([
            ['customer_id', '=', $user_auth->id], 
            ['course_id', '=', $course->id],
            ['status_payment', '=', 'waiting'],
        ])->first();
        
        if ($unpaid_transaction) {
            return $this->dispatchBrowserEvent('notification:alert', ['message' => 'You must complete the previous payment!']);
        }
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');
        
        $start_date_format = \DateTime::createFromFormat('d F Y H:i', $this->start_date)->format('Y-m-d H:i');
        $generated_order_id = "TRX".date('Ymd')."CS".$course->id.$user_auth->id.date('His');
        $admin_fee = 5000;

        $total_amount = ($course->price+$admin_fee);

        $items = array(
            array(
                'id'       => 'item_1',
                'price'    => $course->price,
                'quantity' => 1,
                'name'     => Str::limit('Course: '.$course->title, 47),
            ),
            array(
                'id'       => 'item_2',
                'price'    => $admin_fee,
                'quantity' => 1,
                'name'     => 'Administrative costs'
            )
        );
        $customer_details = array(
            'first_name'       => "",
            'last_name'        => $user_auth->name,
            'email'            => $user_auth->email,
            'phone'            => "",
        );
        $params = array(
            'transaction_details' => array(
                'order_id' => $generated_order_id,
                'gross_amount' => $total_amount,
            ),
            'item_details'        => $items,
            'customer_details'    => $customer_details
        );

        $this->result_snap['order_id'] = $generated_order_id;
        $this->result_snap['total_amount'] = $total_amount;
        // dd($params);
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $this->snap_token = $snapToken;

        CustomerTransaction::create([
            'customer_id' => $user_auth->id,
            'course_id' => $course->id,
            'transaction_code' => $generated_order_id,
            'price' => $course->price,
            'admin_fee' => $admin_fee,
            'total_price' => $total_amount,
            'snap_token' => $snapToken,
            'status_payment' => 'waiting',
            'start_date' => $start_date_format
        ]);

        $this->dispatchBrowserEvent('midtrans:snap_pay', ['snapToken' => $snapToken]);
    }

    public function snapResult($response)
    {
        // dd($response);
        if($response['type'] == 'success' || $response['type'] == 'pending') {
            
            $this->result_snap['is_open'] = true;
            $this->result_snap['payment_type'] = $response['result']['payment_type'];
            $this->result_snap['pdf_payment_method'] = $response['result']['pdf_url'];
            
            if($response['result']['payment_type'] == 'bank_transfer') {
                $this->result_snap['payment_type_readable'] = 'Bank Transfer';
                $va_numbers = $response['result']['va_numbers'];
                
                $this->result_snap['va_bank']['bank'] = $va_numbers[0]['bank'];
                $this->result_snap['va_bank']['va_number'] = $va_numbers[0]['va_number'];
            }
            else if($response['result']['payment_type'] == 'echannel') {
                $this->result_snap['payment_type_readable'] = 'Mandiri Bill';
                $this->result_snap['echannel']['bank'] = 'Mandiri';
                $this->result_snap['echannel']['bill_key'] = $response['result']['bill_key'];
                $this->result_snap['echannel']['biller_code'] = $response['result']['biller_code'];
            }
            else if($response['result']['payment_type'] == 'cstore') {
                $this->result_snap['payment_type_readable'] = 'Outlet Store';
                $this->result_snap['cstore']['payment_code'] = $response['result']['payment_code'];
            }
        }
        $this->dispatchBrowserEvent('midtrans:success_transaction');
    }
}
