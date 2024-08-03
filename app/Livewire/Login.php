<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('YourAppName')->plainTextToken;

            // Store token in session
            session(['token' => $token]);

            // Redirect with token as part of response
            return redirect()->route($user->role_id == 1 ? 'admin.dashboard' : ($user->role_id == 2 ? 'moderator.dashboard' : 'user.dashboard'));
        }

        $this->addError('email', 'Unauthorized');
    }

    public function render()
    {
        return view('livewire.login', [
            'user' => Auth::user(),
        ]);
    }
}
