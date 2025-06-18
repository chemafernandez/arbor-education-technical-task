<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/report_all', [ReportController::class, 'reportAllMessages'])->name('report_all');
Route::get('/report_by_recipient', [ReportController::class, 'reportMessagesByRecipient'])->name('report_by_recipient');
