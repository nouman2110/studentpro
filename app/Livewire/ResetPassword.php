<?php

namespace App\Livewire;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ResetPassword extends Component
{
    public $token, $email, $password, $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            ['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password reset successfully. You can now login.');
            return redirect()->route('login');
        } else {
            session()->flash('error', 'Failed to reset password. Please try again.');
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.reset-password');
    }
}
