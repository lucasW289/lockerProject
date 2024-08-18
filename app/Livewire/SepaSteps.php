<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SepaSteps extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $sepaForm;
    public $full_name;
    public $email;
    public $iban;
    public $bic;
    public $selectedPackage;
    public $childData = ['name' => '', 'birth_date' => '', 'class_id' => ''];
    public $packages;
    public $classes;
    public $sepaDataExists = false;
    public $sepaUploaded = false;
    public $sepaVerified = false;
    public $user;

    protected $listeners = ['saveSEPAData', 'confirmSEPAUpdate', 'resetSEPAData'];

    public function mount()
    {
        $this->packages = \App\Models\Package::all();
        $this->classes = \App\Models\Classes::all();
        $user = auth()->user();
        if (Auth::user()->role_id !== 3) {
            abort(403); // Forbidden
        }
        if (Auth::user())
        {
            $this->user = Auth::user();
        }
        if ($user->sepa) {
            $this->full_name = $user->sepa->full_name;
            $this->email = $user->sepa->email;
            $this->iban = $user->sepa->iban;
            $this->bic = $user->sepa->bic;
            $this->sepaDataExists = true;
            $this->sepaUploaded = !empty($user->sepa->file_path);
            $this->sepaVerified = $user->sepa->verified;
        }
    }

    public function selectOption($step)
    {
        $this->step = $step;
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
    public function submitSEPAForm()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'iban' => 'required|string|max:34',
            'bic' => 'required|string|max:11',
        ]);

        if ($this->sepaDataExists) {
            $this->dispatch('confirm-sepa-update', [
                'full_name' => $this->full_name,
                'email' => $this->email,
                'iban' => $this->iban,
                'bic' => $this->bic,
            ]);
        } else {
            $this->saveSEPAData();
        }
    }

    public function saveSEPAData()
    {
        $user = auth()->user();
        $user->sepa()->updateOrCreate([], [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'iban' => $this->iban,
            'bic' => $this->bic,
        ]);

        $this->sepaDataExists = true;
        $this->sepaUploaded = false; // Reset upload status
        $this->sepaVerified = false; // Reset verification status
        $this->step = 4; // Redirect to download step after saving SEPA data
        $this->dispatch('sepa-saved', ['message' => 'SEPA data saved successfully.\n Please download Sepa pdf for signature.']);
    }

    public function confirmSEPAUpdate($data)
    {
        $this->full_name = $data['full_name'];
        $this->email = $data['email'];
        $this->iban = $data['iban'];
        $this->bic = $data['bic'];
        $this->saveSEPAData();
    }

    public function downloadExistingSepa()
    {
        if (!$this->sepaDataExists) {
            session()->flash('error', 'No SEPA data available. Please fill out SEPA info first.');
            return;
        }
    
        return redirect()->route('sepa.download');
    }
    
    public function uploadSepaForm()
    {
        $this->validate([
            'sepaForm' => 'required|mimes:pdf|max:2048',
        ]);
    
        if (!$this->sepaDataExists) {
            session()->flash('error', 'No SEPA data available. Please fill out SEPA info first.');
            return;
        }
    
        $filePath = $this->sepaForm->store('sepa_forms', 'public');
    
        $user = auth()->user();
        $user->sepa()->updateOrCreate([], [
            'file_path' => $filePath,
            'uploaded' => true,
            'verified' => 'Pending', // Set default status to Pending
        ]);
    
        $this->sepaUploaded = true;
        $this->sepaVerified = 'Pending'; // Initialize as Pending
        $this->reset('sepaForm');
        $this->dispatch('sepa-uploaded', ['message' => 'SEPA form uploaded successfully.']);
    }
    

    public function resetSEPAData()
    {
        $this->full_name = '';
        $this->email = '';
        $this->iban = '';
        $this->bic = '';
        $this->sepaDataExists = false;
        $this->sepaUploaded = false;
        $this->sepaVerified = false;
    }

    public function render()
    {
        return view('livewire.sepa-steps');
    }
}
