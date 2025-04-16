<?php

use App\Livewire\CustomLogin;
use App\Livewire\ForgotPassword;
use App\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
Route::get('/', function () {
    return redirect()->route('login');
 });

 Route::redirect('/admin/login', '/login');

 Route::get('/login', CustomLogin::class)->name('login');
 Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
 Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
 

//  Route::get('/test-email', function () {
//     Mail::raw('This is a test email.', function ($message) {
//         $message->to('rana.noman2110@yahoo.com')
//                 ->subject('Test Email');
//     });
//     return 'Email Sent Successfully';
// });
