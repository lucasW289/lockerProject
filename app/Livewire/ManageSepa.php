<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Sepa;
use Illuminate\Support\Facades\Auth;


class ManageSepa extends Component
{
    use WithFileUploads;

    public $sepas;
    public $selectedSepa;
    public $file;
    public $verificationStatus; // For managing verification status

    public function mount()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403); // Forbidden
        }
        $this->sepas = Sepa::all(); // Fetch all SEPA records
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
    public function selectSepa($id)
    {
        $this->selectedSepa = Sepa::find($id);
        $this->verificationStatus = $this->selectedSepa->verified; // Initialize verification status
    }

    public function uploadFile()
    {
        $this->validate([
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($this->file) {
            $path = $this->file->store('sepa_forms', 'public');

            $this->selectedSepa->update([
                'file_path' => $path,
                'uploaded' => 1,
                'verified' => $this->verificationStatus, // Update verification status
            ]);

            session()->flash('message', 'File uploaded and status updated successfully.');
            $this->reset('file'); // Reset the file input after upload
            return redirect()->route('manage.sepa'); // Replace 'manage-sepa' with your route name

        }
    }

    public function updateStatus()
    {
        if ($this->selectedSepa) {
            $this->selectedSepa->update([
                'verified' => $this->verificationStatus,
            ]);

            session()->flash('message', 'SEPA status updated successfully.');
        }
    }

    public function render()
    {
        return view('livewire.manage-sepa');
    }
}
