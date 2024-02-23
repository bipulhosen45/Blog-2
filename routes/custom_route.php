<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('pdf', [PDFController::class, 'index']);
Route::get('custom-data', [PDFController::class, 'customData'])





?>