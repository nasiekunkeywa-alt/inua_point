<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\LoanVerificationController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Redirect authenticated users to dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Loans CRUD
    Route::resource('loans', LoanController::class)->except(['show'])->names('loans');

    // Payments
    Route::get('payments', [LoanPaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [LoanPaymentController::class, 'create'])->name('payments.create');
    Route::post('payments', [LoanPaymentController::class, 'store'])->name('payments.store');

    // Verifications
    Route::get('verifications', [LoanVerificationController::class, 'index'])->name('verifications.index');
    Route::post('verifications/{verification}/approve', [LoanVerificationController::class, 'approve'])->name('verifications.approve');
    Route::post('verifications/{verification}/reject', [LoanVerificationController::class, 'reject'])->name('verifications.reject');

    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
