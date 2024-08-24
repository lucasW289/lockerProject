<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;


class AddPackagePlan extends Component
{
    public $name;
    public $description;
    public $price;
    public $packageId;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|unique:packages,name',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->packageId = null;
        $this->isEditing = false;
    }

    public function submit()
{
    $this->validate();

    if ($this->isEditing) {
        $package = Package::find($this->packageId);

        if ($package) {
            $package->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
            ]);

            session()->flash('message', 'Package plan updated successfully.');
        } else {
            session()->flash('error', 'Package not found.');
        }
    } else {
        Package::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Package plan created successfully.');
    }

    $this->resetForm();
}


    public function edit(Package $package)
    {
        $this->name = $package->name;
        $this->description = $package->description;
        $this->price = $package->price;
        $this->packageId = $package->id;
        $this->isEditing = true;
    }

    public function delete($id)
    {
        $package = Package::find($id);
    
        if ($package) {
            $package->delete();
            session()->flash('message', 'Package plan deleted successfully.');
        } else {
            session()->flash('error', 'Package not found.');
        }
    }
    

    public function render()
    {
        $packages = Package::all();

        return view('livewire.add-package-plan', [
            'packages' => $packages,
        ]);
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
}
