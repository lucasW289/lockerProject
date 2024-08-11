<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Locker;
use App\Models\User;
use App\Models\Sepa;

class AdminDashboard extends Component
{
    public $user;
    public $totalLockersCount;
    public $availableLockersCount;
    public $lockersInUseCount;
    public $lockersOutOfServiceCount;
    public $totalUserCount;
    public $sepaPendingCount;

    public function mount()
    {
        // Ensure only users with role_id 3 (Regular User) can access this dashboard
        if (Auth::user()->role_id !== 1) {
            abort(403); // Forbidden
        }
        if (Auth::user()) {
            $this->user = Auth::user();

        }
        // Calculate  counts
        $this->totalUserCount = User::count();
        $this->totalLockersCount = Locker::count();
        $this->availableLockersCount = Locker::where('status', 'Available')->count();
        $this->lockersInUseCount = Locker::where('status', 'In Use')->count();
        $this->lockersOutOfServiceCount = Locker::where('status', 'Out of Service')->count();
        $this->sepaPendingCount = SEPA::where('Verified', 'Pending')->count();

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
        return view('livewire.admin-dashboard');
    }
}
