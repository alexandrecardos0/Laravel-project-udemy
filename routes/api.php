<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('payments', PaymentController::class);
