<?php

use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'frontend.pages.index')->name('home');

Route::get('/partner-register', [PartnerController::class, 'create'])->name('partner.register');
Route::post('/partner-register', [PartnerController::class, 'store'])->name('partner.register.store');
Route::post('/partner-check-unique', [PartnerController::class, 'checkUnique'])->name('partner.check.unique');
Route::get('/partner-application/pdf/{code}', [PartnerController::class, 'downloadApplicationPdf'])->name('partner.application.pdf');
Route::get('/partner-application/view-pdf/{code}', [PartnerController::class, 'viewApplicationPdf'])->name('partner.application.view_pdf');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/admin-routes.php';
