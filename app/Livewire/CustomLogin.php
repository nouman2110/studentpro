<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
class CustomLogin extends Component
{
    public $email, $password;

    public function login()
    {
        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->route('filament.admin.pages.dashboard');
        }

        session()->flash('error', 'Invalid credentials. Please try again.');
    }
    #[Layout('components.layouts.app')] 
    public function render()
    {
        return view('livewire.custom-login'); 
    }
}
