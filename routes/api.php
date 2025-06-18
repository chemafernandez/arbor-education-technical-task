<?php

use App\Http\Controllers\IngestController;
use Illuminate\Support\Facades\Route;

Route::get('/ingest', [IngestController::class, 'index']);