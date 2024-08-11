<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public $user;
    public function mount()
    {
        // Ensure only users with role_id 3 (Regular User) can access this dashboard
        if (Auth::user()->role_id !== 3) {
            abort(403); // Forbidden
        }
        if (Auth::user())
        {
            $this->user = Auth::user();
        }
    }

    public function logout()
    {
        // For Sanctum, log out the user and invalidate their session
        Auth::guard('web')->logout(); // Use 'web' guard for session-based authentication

        // Optionally invalidate the user's API tokens
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete(); // Delete all tokens for the user
        }

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login'); // Redirect to the login page
    }

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}

