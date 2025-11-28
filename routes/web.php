<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/download/{id}/{file}', [\App\Http\Controllers\FileController::class, 'download'])->name('download');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('subscribe', \App\Http\Controllers\SubscribeController::class)->name('subscribe');
    Volt::route('invoices', 'invoices')->name('invoices.index');
    Volt::route('invoices/{invoice}', 'invoice.show')->name('invoices.show');
    Volt::route('signup', 'signup')->name('signup');
    Volt::route('wizard/', 'wizard.info')->name('wizard.info');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Volt::route('users', 'user')->name('users.index');
    Volt::route('users/{id}/edit', 'user.edit')->name('users.edit');
    Route::get('wordpress/login/{id}', [\App\Http\Controllers\WordpressController::class, 'login'])->name('wordpress.login');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
