<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\UserRegistration;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {
        $newPassword = Str::random(10);
        $data['password'] = bcrypt($newPassword);
        $user = static::getModel()::create($data);
        $user->roles()->sync($data['roles'] ?? [2]); 
        $loginLink = url('/admin/login');
        Mail::to($user->email)->send(new UserRegistration($user, $newPassword, $loginLink));
    
        return $user;
    }
    
    
}
