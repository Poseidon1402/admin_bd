<?php

use App\Http\Controllers\AuditVirementController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VirementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('signin');
})->name('sign_in_screen');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/subscribe', [LoginController::class, 'subscribe'])->name('signup');
Route::post('/subscribe', [LoginController::class, 'store']);

Route::get('/virements', [VirementController::class, 'lists'])->name('virements_list')->middleware(['auth.session']);

Route::post('/virements', [VirementController::class, 'store'])->name('store_virement')->middleware(['auth.session']);

Route::get('/audit_virements', [AuditVirementController::class, 'lists'])->name('audit_virement_list')->middleware(['auth.session']);