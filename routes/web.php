<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BMADController;

Route::get('/', [BMADController::class, 'index'])->name('bmad.index');
Route::post('/generate', [BMADController::class, 'generate'])->name('bmad.generate');
Route::get('/preview', [BMADController::class, 'preview'])->name('bmad.preview');
Route::get('/download', [BMADController::class, 'download'])->name('bmad.download');
Route::post('/refine', [BMADController::class, 'refine'])->name('bmad.refine');
