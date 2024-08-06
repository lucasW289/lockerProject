<?php
// app/Http/Livewire/RentLocker.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Package;
use App\Models\Classes;
use App\Models\Child;
use Illuminate\Support\Facades\Auth;

class RentLocker extends Component
{
    public $step = 1;
    public $selectedPackage = null;
    public $childData = [
        'name' => '',
        'birth_date' => '',
        'class_id' => '',
    ];
    public $packages;
    public $classes;

    public function mount()
    {
        $this->packages = Package::all();
        $this->classes = Classes::all();
    }

    public function goToStep($step)
    {
        $this->step = $step;
    }

    public function selectPackage($packageId)
    {
        $this->selectedPackage = $packageId;
    }

    public function submitPackage()
    {
        if ($this->selectedPackage) {
            $this->step = 2;
        }
    }

    public function submitChildData()
    {
        $this->validate([
            'childData.name' => 'required|string|max:255',
            'childData.birth_date' => 'required|date',
            'childData.class_id' => 'required|exists:classes,id',
        ]);

        Child::create([
            'name' => $this->childData['name'],
            'birth_date' => $this->childData['birth_date'],
            'class_id' => $this->childData['class_id'],
            'user_id' => Auth::id(),
            'package_id' => $this->selectedPackage,
        ]);

        session()->flash('message', 'Child registered successfully!');
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.rent-locker');
    }
}
