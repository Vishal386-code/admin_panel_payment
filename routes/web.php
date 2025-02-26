<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PaymentController;



Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/payment', [PaymentController::class, 'index'])->name('admin.payment');
    Route::delete('/admin/payment/{id}', [PaymentController::class, 'destroy'])->name('admin.payment.destroy');
    Route::post('/admin/payment/store', [PaymentController::class, 'store'])->name('admin.payment.store');
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('admin.payment.edit');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('admin.payment.update');
    
});

