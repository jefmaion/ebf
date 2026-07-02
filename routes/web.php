<?php

declare(strict_types = 1);

use App\Livewire\Checkin\CheckinCam;
use App\Livewire\Checkin\CheckinPage;
use App\Livewire\Dashboard;
use App\Livewire\Participant\ParticipantPage;
use App\Livewire\Profile;
use App\Livewire\Register\RegisterForm;
use App\Livewire\Register\RegisterSuccess;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('event-register', RegisterForm::class)->name('register-form');
Route::get('success', RegisterSuccess::class)->name('success');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');


    Route::get('participants', ParticipantPage::class)->name('participant');
    Route::get('checkin', CheckinPage::class)->name('checkin');
    Route::get('checkin-cam', CheckinCam::class)->name('cam');
});

require __DIR__ . '/auth.php';
