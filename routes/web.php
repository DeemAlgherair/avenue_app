<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAuthController;

use App\Http\Controllers\AvenueController;
use App\Http\Controllers\OwnerController;





Route::get('/login', [AuthController::class, 'loginIndex'])->name('loginIndex');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/login-customer', [UserAuthController::class, 'index'])->name('customerloginIndex');
Route::post('/login-customer', [UserAuthController::class, 'customerLogin'])->name('customerLogin');



Route::get('/register', [UserAuthController::class, 'registerIndex'])->name('registerIndex');
Route::post('/register', [UserAuthController::class, 'register'])->name('register');

Route::get('/forgot-password', [AuthController::class, 'forgotPasswordIndex'])->name('forgotPasswordIndex');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword']);
Route::post('/reset-password', [AuthController::class, 'storeResetPassword'])->name('resetPassowrd');




Route::prefix('Admin-Online-Avenue')->middleware(['admin'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('AdminDashboard');
    Route::get('/show-avenue', [AvenueController::class, 'index'])->name('showAvenue');
    Route::get('/show-owner', [OwnerController::class, 'index'])->name('showOwner');
    Route::delete('show-owner/{id}/edit-owner', [OwnerController::class, 'destroy'])->name('deleteOwner');
    Route::get('show-owner/{id}/edit-owner', [OwnerController::class, 'edit']);
    Route::put('show-owner/{id}/edit-owner', [OwnerController::class, 'update'])->name('updateOwner');
    Route::get('create-owner', [OwnerController::class, 'create'])->name('showCreateOwner');
    Route::post('create-owner', [OwnerController::class, 'store'])->name('createOwner');


    


});    
    
    