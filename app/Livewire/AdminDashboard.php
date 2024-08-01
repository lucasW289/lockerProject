<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public function mount()
    {
        // Ensure only users with role_id 1 (Admin) can access this dashboard
        if (Auth::user()->role_id !== 1) {
            abort(403); // Forbidden
        }
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
