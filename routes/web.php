<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // *
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // *
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // *
  

    // Gestión de propiedades
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create'); // *
    Route::get('/properties/active', [PropertyController::class, 'showActiveProperties'])->name('properties.active'); // *
    Route::get('/properties/transactions', [PropertyController::class, 'showTransactions'])->name('properties.transactions');
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index'); // *
    Route::get('properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit'); // *
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show'); // *
    Route::put('properties/{id}', [PropertyController::class, 'update'])->name('properties.update'); // *
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy'); // *
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store'); // *
    Route::get('/properties/buy/{id}', [PropertyController::class, 'buy'])->name('properties.buy');


    Route::post('/properties/buy/{property}', [TransactionController::class, 'store'])->name('transactions.create');
});



Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Mostrar lista de usuarios no admin
    Route::get('/admin/users', [AdminController::class, 'showMembersUsers'])->name('admin.users');

    // Editar un usuario
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

    // Actualizar un usuario
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.destroy');

    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.verify-transactions');
    Route::post('/admin/transactions/accept/{transaction}', [TransactionController::class, 'accept'])->name('transactions.accept');
    Route::post('/admin/transactions/cancel/{transaction}', [TransactionController::class, 'cancel'])->name('transactions.cancel');

});

require __DIR__.'/auth.php';
