<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

// Ruta principal
Route::get('/', function () {
    return view('auth.login');
});

// Ruta del dashboard, con middleware para autenticación
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // ** Perfil del usuario **
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Mostrar perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Actualizar perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Eliminar perfil

    // ** Gestión de propiedades **
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create'); // Crear propiedad
    Route::get('/properties/active', [PropertyController::class, 'showActiveProperties'])->name('properties.active'); // Propiedades activas
    Route::get('/properties/transactions', [PropertyController::class, 'showTransactions'])->name('properties.transactions'); // Ver transacciones
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index'); // Listar propiedades
    Route::get('properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit'); // Editar propiedad
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show'); // Mostrar propiedad
    Route::put('properties/{id}', [PropertyController::class, 'update'])->name('properties.update'); // Actualizar propiedad
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy'); // Eliminar propiedad
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store'); // Guardar propiedad
    Route::get('/properties/buy/{id}', [PropertyController::class, 'buy'])->name('properties.buy'); // Comprar propiedad

    // ** Transacciones **
    Route::post('/properties/buy/{property}', [TransactionController::class, 'store'])->name('transactions.create'); // Crear transacción

});

// Rutas protegidas por autenticación y middleware de Admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    // ** Administración de usuarios **
    Route::get('/admin/users', [AdminController::class, 'showMembersUsers'])->name('admin.users'); // Mostrar usuarios no admin
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit'); // Editar usuario
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.update'); // Actualizar usuario
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.destroy'); // Eliminar usuario

    // ** Administración de transacciones **
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.verify-transactions'); // Ver transacciones pendientes
    Route::post('/admin/transactions/accept/{transaction}', [TransactionController::class, 'accept'])->name('transactions.accept'); // Aceptar transacción
    Route::post('/admin/transactions/cancel/{transaction}', [TransactionController::class, 'cancel'])->name('transactions.cancel'); // Cancelar transacción

});

// Autenticación
require __DIR__.'/auth.php';
