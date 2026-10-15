<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EpController;
use App\Http\Controllers\admin\GpController;
use App\Http\Controllers\admin\InvestorController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication (Public)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes (Guard: admin)
    Route::middleware(['auth:admin'])->group(function () {
        // Logout
        Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard Overview
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Executive Partners (EP) Management
        Route::get('/ep', [EpController::class, 'index'])->name('ep.index');
        Route::get('/ep/{id}', [EpController::class, 'show'])->name('ep.show');
        Route::delete('/ep/{id}', [EpController::class, 'destroy'])->name('ep.destroy');

        // Ground Partners (GP) Management
        Route::get('/gp', [GpController::class, 'index'])->name('gp.index');
        Route::get('/gp/{id}', [GpController::class, 'show'])->name('gp.show');
        Route::delete('/gp/{id}', [GpController::class, 'destroy'])->name('gp.destroy');

        // Dynamic Website Content Settings (Phone, Email, Support, Investor Liaison)
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Investor Portal
        Route::get('/investor', [InvestorController::class, 'index'])->name('investor.index');

        // Contact Inquiries
        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.show');
        Route::post('/contact/{id}/toggle-status', [ContactController::class, 'toggleStatus'])->name('contact.toggleStatus');
        Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

        // Admin Profile & Settings
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    });
});
