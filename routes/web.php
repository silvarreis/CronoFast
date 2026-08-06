<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RefInternalController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\TimePartController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\PdfController;

Route::get('/stopwatch', function () {
    return view('layouts.stopwatch');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::redirect('/', '/stopwatch');


Route::get('/dashboard/show/{id}', [TimePartController::class, 'show'])->middleware(['auth', 'verified']);
Route::delete('/dashboard/show/{ref?}/{id}/delete', [TimePartController::class, 'delete'])->middleware(['auth', 'verified']);
Route::post('/dashboard/search', [TimePartController::class, 'search'])->name('dash.search');
Route::delete('/dashboard/show/{ref?}/{id}/time/delete', [TimePartController::class, 'deleteTime'])->middleware(['auth', 'verified']);

Route::post('/stopwatch', [TimePartController::class, 'store'])->middleware(['auth', 'verified'])->name('stopwatch.store');
Route::get('/dashboard',  [TimePartController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/operation', [OperationController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/operation', [OperationController::class, 'store'])->middleware(['auth', 'verified'])->name('operation.store');
Route::get('/operation/{id}/edit', [OperationController::class, 'edit'])->middleware(['auth', 'verified']);
Route::put('/operation/{id}', [OperationController::class, 'update'])->middleware(['auth', 'verified']);
Route::delete('/operation/{id}/delete', [OperationController::class, 'softDelete'])->middleware(['auth', 'verified']);
Route::get('/operation', [OperationController::class, 'show'])->name('operation.show');

Route::get('/refIternal', [RefInternalController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/refIternal', [RefInternalController::class, 'store'])->middleware(['auth', 'verified'])->name('refIternal.store');
Route::get('/refIternal/{id}/edit', [RefInternalController::class, 'edit'])->middleware(['auth', 'verified']);
Route::put('/refIternal/{id}', [RefInternalController::class, 'update'])->middleware(['auth', 'verified']);
Route::delete('/refIternal/{id}/delete', [RefInternalController::class, 'delete'])->middleware(['auth', 'verified']);
Route::get('/refIternal', [RefInternalController::class, 'show'])->name('refIternal.show');

Route::get('/employee', [EmployeeController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/employee', [EmployeeController::class, 'store'])->middleware(['auth', 'verified'])->name('employee.store');
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->middleware(['auth', 'verified']);
Route::put('/employee/{id}', [EmployeeController::class, 'update'])->middleware(['auth', 'verified']);
Route::delete('/employee/{id}/delete', [EmployeeController::class, 'delete'])->middleware(['auth', 'verified']);
Route::get('/employee/show', [EmployeeController::class, 'show'])->middleware(['auth', 'verified'])->name('employee.show');


Route::get('/machine', [MachineController::class, 'index'])->middleware(['auth', 'verified']);
Route::post('/machine', [MachineController::class, 'store'])->middleware(['auth', 'verified'])->name('machine.store');
Route::get('/machine/{id}/edit', [MachineController::class, 'edit'])->middleware(['auth', 'verified']);
Route::put('/machine/{id}', [MachineController::class, 'update'])->middleware(['auth', 'verified']);
Route::delete('/machine/{id}/delete', [MachineController::class, 'delete'])->middleware(['auth', 'verified']);
Route::get('/machine', [MachineController::class, 'show'])->name('operation.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
