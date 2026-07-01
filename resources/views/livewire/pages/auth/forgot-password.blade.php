<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <h2 class="card-title text-center mb-4">{{ __('Forgot password') }}</h2>
    <p class="text-secondary mb-4">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

        <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form wire:submit="sendPasswordResetLink">
    <div class="mb-3">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input wire:model="email" id="email" type="email" name="email" required autofocus />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div class="form-footer">
        <button type="submit" class="btn btn-primary btn-4 w-100">
            <x-icons.mail />
            {{ __('Email Password Reset Link') }}
        </button>
    </div>
    </form>

    <x-slot:link>
        <div class="text-center text-secondary mt-3">{{ __('Forget it') }}, <a href="{{ route('login') }}">{{ __('Send me back') }}</a> {{ __('To the sign in screen.') }}</div>
    </x-slot:link>
</div>
