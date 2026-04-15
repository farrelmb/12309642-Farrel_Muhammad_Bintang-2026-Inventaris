<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LendingStaffController;
use App\Http\Controllers\ItemStaffController;

// ======================
// LANDING
// ======================
Route::get('/', function () {
    return view('landing');
});

// ======================
// LOGIN
// ======================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ======================
// LOGOUT
// ======================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ======================
// ADMIN
// ======================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        return view('adm.dashboardadm');
    });

    // USERS
    Route::get('/users/admin', [UserController::class, 'index']);
    Route::get('/users/operator', [UserController::class, 'staff']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users/store', [UserController::class, 'store']);
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('/users/update/{id}', [UserController::class, 'update']);
    Route::get('/users/delete/{id}', [UserController::class, 'delete']);

    // CATEGORIES & ITEMS
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
});


// ======================
// STAFF
// ======================
Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff', function () {
        return view('stff.dashboardstff');
    });

    // PROFILE
    Route::get('/profile/edit', [UserController::class, 'editProfile']);
    Route::post('/profile/update', [UserController::class, 'updateProfile']);
});

Route::prefix('staff')->group(function () {
    Route::get('/lending', [LendingStaffController::class, 'index'])->name('lendingstff.index');
    Route::get('/lending/create', [LendingStaffController::class, 'create'])->name('lendingstff.create');
    Route::post('/lending/store', [LendingStaffController::class, 'store'])->name('lendingstff.store');
    Route::put('/lending/returned/{id}', [LendingStaffController::class, 'returned'])->name('lendingstff.returned');
    Route::delete('/lending/delete/{id}', [LendingStaffController::class, 'destroy'])->name('lendingstff.destroy');

    Route::get('/itemstff', [ItemStaffController::class, 'index'])->name('itemstff.index');
});