<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/documents/queue-import', [DocumentController::class, 'queueImport'])->name('documents.queueImport');
Route::post('/documents/process-queue', [DocumentController::class, 'processQueue'])->name('documents.processQueue');
