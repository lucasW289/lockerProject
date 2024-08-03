<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Package;
use App\Models\Child;
use App\Models\Classes; // Import the Classes model

class RentLocker extends Component
{
    public $step = 1;
    public $childData = [
        'name' => '',
        'birth_date' => '',
        'class_id' => '', // Ensure class_id is part of the data
    ];
    public $sepaData = [
        'bank_name' => '',
        'iban' => '',
    ];
    public $selectedPackage = null;
    public $packages;
    public $classes; // Add this property to store classes

    public function mount()
    {
        // Fetch packages and classes for selection
        $this->packages = Package::all();
        $this->classes = Classes::all(); // Fetch classes
    }

    public function render()
    {
        return view('livewire.rent-locker');
    }

    public function goToStep($step)
    {
        if ($step === 1) {
            // Clear selected package if moving back to step 1
            $this->selectedPackage = null;
        }
        $this->step = $step;
    }

    public function selectPackage($packageId)
    {
        $this->selectedPackage = $packageId;
    }

    public function submitPackage()
    {
        $this->validate([
            'selectedPackage' => 'required|exists:packages,id',
        ]);

        // Store selected package and move to next step
        $this->step = 2;
    }

    public function submitChildData()
    {
        $this->validate([
            'childData.name' => 'required|string|max:255',
            'childData.birth_date' => 'required|date',
            'childData.class_id' => 'required|exists:classes,id', // Add validation for class_id
        ]);
       
        // Retrieve the currently authenticated user's ID
        $userId = auth()->id(); // Ensure the user is authenticated

        // Save child data along with the selected package, user ID, and class ID
        Child::create([
            'name' => $this->childData['name'],
            'birth_date' => $this->childData['birth_date'],
            'package_id' => $this->selectedPackage, // Store the selected package
            'user_id' => $userId, // Store the ID of the currently logged-in user
            'class_id' => $this->childData['class_id'], // Store the selected class
        ]);

        // Move to the next step
        $this->step = 3;
    }

    public function submitSepaData()
    {
        $this->validate([
            'sepaData.bank_name' => 'required|string|max:255',
            'sepaData.iban' => 'required|string|max:34', // Example IBAN length
        ]);

        // Store SEPA data
        $this->step = 4;
    }

    public function uploadSepaForm()
    {
        $this->validate([
            'sepaForm' => 'required|file|mimes:pdf|max:2048', // Validate file upload
        ]);

        // Handle SEPA form upload
        // You may want to store the file and update the relevant record

        $this->step = 5;
    }
}
