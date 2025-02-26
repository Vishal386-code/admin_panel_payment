@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="container-fluid py-4">
        <p class="mb-4 text-muted fw-bold">
            Dashboard → <span class="text-primary">Profile\Password</span>
        </p>
        
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8" style="text-align:center;">
            <!-- Toggle Buttons -->
            <div class="flex justify-center space-x-4 mb-6">
                <button class="toggle-btn active" data-target="#profile-section">Profile Update</button>
                <button class="toggle-btn" data-target="#password-section">Password Update</button>
            </div>
            <!-- Profile Update Form -->
            <div id="profile-section" class="form-box">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')
                    <x-section-border />
                @endif
            </div>
            <!-- Password Update Form -->
            <div id="password-section" class="form-box hidden">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    @livewire('profile.update-password-form')
                    <x-section-border />
                @endif
            </div>
        </div>
    </div>


    <style>
        
    </style>
@endsection
