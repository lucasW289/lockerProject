<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public function mount()
    {
        // Ensure only users with role_id 3 (Regular User) can access this dashboard
        if (Auth::user()->role_id !== 3) {
            abort(403); // Forbidden
        }
    }

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}

