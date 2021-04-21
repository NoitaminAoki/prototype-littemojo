<?php

namespace App\Http\Livewire\Homepages\Dashboard;

use Livewire\Component;

class LvDashboard extends Component
{
    public function render()
    {
        $data = [];

        return view('homepage.pages.dashboard.dashboard_index')
        ->with($data)
        ->layout('homepage.user_layouts.lv_main');
    }
}
