<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id = 3; // Default role for new users

    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {
        // Validate the input data
        $validatedData = Validator::make([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ])->validate();

        // Create a new user
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->role_id, // Assign the role_id
        ]);

        // Dispatch JavaScript event
        $this->dispatch('registration-success');
    }
}
