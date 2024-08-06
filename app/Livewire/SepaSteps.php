<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function mount()
    {
        $this->packages = \App\Models\Package::all();
        $this->classes = \App\Models\Classes::all(); // Use the correct model name
        $user = auth()->user();

        if ($user->sepa) {
            $this->full_name = $user->sepa->full_name;
            $this->email = $user->sepa->email;
            $this->iban = $user->sepa->iban;
            $this->bic = $user->sepa->bic;
            $this->sepaDataExists = true;
        }

        if ($user->sepa && $user->sepa->sepa_form_path) {
            $this->sepaUploaded = true;
        }
    }

    public function selectOption($step)
    {
        $this->step = $step;
    }

    public function submitSEPAForm()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'iban' => 'required|string|max:34',
            'bic' => 'required|string|max:11',
        ]);

        // Save SEPA data
        $user = auth()->user();
        $user->sepa()->updateOrCreate([], [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'iban' => $this->iban,
            'bic' => $this->bic,
        ]);

        $this->sepaDataExists = true;
        $this->step = 4; // Redirect to download step after saving SEPA data
    }

    public function generateSepaPdf()
    {
        $data = [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'iban' => $this->iban,
            'bic' => $this->bic,
        ];

        $pdf = Pdf::loadView('user.sepa-pdf', $data);

        return $pdf->download('sepa_form.pdf');
    }

    public function downloadExistingSepa()
    {
        if (!$this->sepaDataExists) {
            session()->flash('error', 'No SEPA data available.');
            return;
        }

        return $this->generateSepaPdf();
    }

    public function uploadSepaForm()
    {
        $this->validate([
            'sepaForm' => 'required|mimes:pdf|max:10240', // 10MB max
        ]);

        $filePath = $this->sepaForm->store('sepa_forms');

        // Save the file path to the user's SEPA data or another appropriate place
        $user = auth()->user();
        $user->sepa()->updateOrCreate([], [
            'sepa_form_path' => $filePath,
        ]);

        $this->sepaUploaded = true;
        session()->flash('message', 'SEPA form uploaded successfully.');
    }

    public function render()
    {
        return view('livewire.sepa-steps');
    }
}
