<?php

namespace App\Livewire\Admin;

use Livewire\Component;

#[\Livewire\Attributes\Layout('admin.layouts.app')]
class DashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-component');
    }
}
