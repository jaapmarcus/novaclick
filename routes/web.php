<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    //redirect to login
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/download/{id}/{file}', [\App\Http\Controllers\FileController::class, 'download'])->name('download');
Route::get('/invoice/download/{number}', [\App\Http\Controllers\InvoiceController::class, 'download'])->name('invoice.download');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('subscribe', \App\Http\Controllers\SubscribeController::class)->name('subscribe');
    Volt::route('invoices', 'invoices')->name('invoices.index');
    Volt::route('invoices/{invoice}', 'invoice.show')->name('invoices.show');
    Volt::route('signup', 'signup')->name('signup');
    Volt::route('wizard/', 'wizard.info')->name('wizard.info');
    Route::get('wordpress/', [\App\Http\Controllers\WordpressController::class, 'wordpress'])->name('wordpress');
    Route::get('wordpress/login/', [\App\Http\Controllers\WordpressController::class, 'login'])->name('wordpress.client.login');
    Volt::route('faq', 'faq')->name('faq.index');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Volt::route('users', 'user')->name('users.index');
    Volt::route('users/{id}/edit', 'user.edit')->name('users.edit');
    Route::get('wordpress/login/{id}', [\App\Http\Controllers\WordpressController::class, 'login'])->name('wordpress.login');
    Volt::route('categories', 'category')->name('categories.index');
    Volt::route('faqs', 'faqAdmin')->name('faqs.index');
    Volt::route('ticket', 'Ticket')->name('tickets.index');

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
