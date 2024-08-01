<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ModeratorDashboard extends Component
{
    public function mount()
    {
        // Ensure only users with role_id 2 (Moderator) can access this dashboard
        if (Auth::user()->role_id !== 2) {
            abort(403); // Forbidden
        }
    }

    public function render()
    {
        return view('livewire.moderator-dashboard');
    }
}

