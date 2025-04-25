<?php

use Illuminate\Support\Facades\Route;
use Visal\PhonePe\Http\Controllers\PhonePeRedirectController;

Route::get('/payment/success', [PhonePeRedirectController::class, 'success'])->name('payment.success');
Route::get('/payment/failure', [PhonePeRedirectController::class, 'failure'])->name('payment.failure');
