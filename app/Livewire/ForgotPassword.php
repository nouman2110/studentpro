<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ForgotPassword extends Component
{
    public $email;

    public function sendResetLink()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Password reset link sent to your email.');
        } else {
            session()->flash('error', 'Unable to send reset link. Please try again.');
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.forgot-password');
    }
}
