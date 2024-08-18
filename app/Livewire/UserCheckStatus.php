<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Child;
use App\Models\Locker;
use App\Models\Sepa;
use Illuminate\Support\Facades\Auth;

class UserCheckStatus extends Component
{
    public $childrenList = [];
    public $sepaStatus = '';
    public $sepaStatusClass = ''; // Added for status color class
    public $lockers = [];
    public $user;

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
    public function mount()
    {
        $userId = auth()->id(); // Get the currently authenticated user ID
        $user = auth()->user();
        if (Auth::user()->role_id !== 3) {
            abort(403); // Forbidden
        }
        if (Auth::user())
        {
            $this->user = Auth::user();
        }
        // Fetch SEPA status
        $sepa = Sepa::where('user_id', $userId)->first();
        if ($sepa) {
            if ($sepa->uploaded === 1) {
                if ($sepa->verified === 'Verified') {
                    $this->sepaStatus = 'SEPA form uploaded and verified';
                    $this->sepaStatusClass = 'text-green-600'; // Green for verified
                } else {
                    $this->sepaStatus = 'SEPA form uploaded but not yet verified. Please contact school administration immediately for further assistance.';
                    $this->sepaStatusClass = 'text-yellow-600'; // Yellow for not verified
                }
            } else {
                $this->sepaStatus = 'Please complete the SEPA form upload process to ensure your information is updated.';
                $this->sepaStatusClass = 'text-red-600'; // Red for not uploaded
            }
        } else {
            $this->sepaStatus = 'SEPA form not uploaded';
            $this->sepaStatusClass = 'text-red-600'; // Red for not uploaded
        }

        // Fetch all children for the user
        $this->childrenList = Child::where('user_id', $userId)->get()->map(function ($child) {
            // Fetch locker information
            $child->locker_info = $child->locker_id ? Locker::find($child->locker_id) : null;
            return $child;
        })->toArray();

        // Fetch all lockers
        $this->lockers = Locker::all();
    }

    public function render()
    {
        return view('livewire.user-check-status', [
            'lockers' => $this->lockers,
        ]);
    }
}
