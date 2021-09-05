<?php

namespace App\Http\Livewire\Homepages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    CustomerCertificate as UserCertificate,
};

class LvCertificateVerify extends Component
{
    public $hash_id;

    public function mount($hash_id)
    {
        $this->hash_id = $hash_id;
    }

    public function render()
    {
        $data['certificate'] = UserCertificate::where('hash_id', $this->hash_id)->firstOrFail();
        $course = $data['certificate']->course;
        $data['course_rating'] = $course->getDetailRating();
        $data['total_student'] = $course->getTotalEnrolled();
        return view('homepage.pages.certificates.certificate_verify')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }
}
