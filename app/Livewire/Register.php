<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id = 3; // Default role for new users

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:8',
    ];

    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {
        // Validate the input data
        $this->validate();

        // Create a new user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->role_id, // Assign the role_id
        ]);

        // Log in the user
        Auth::login($user);

        // Create a token for the user
        $token = $user->createToken('YourAppName')->plainTextToken;

        // Store token in session
        session(['token' => $token]);

        // Dispatch JavaScript event
        $this->dispatch('registration-success', [
            'redirectUrl' => route($user->role_id == 1 ? 'admin.dashboard' : ($user->role_id == 2 ? 'moderator.dashboard' : 'user.dashboard')),
        ]);
    }
}
