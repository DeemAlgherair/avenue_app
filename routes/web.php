<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AvenueController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\IndexController;

use App\Http\Controllers\profileController;







Route::get('/login', [AuthController::class, 'loginIndex'])->name('loginIndex');
Route::post('/login', [AuthController::class, 'login'])->name('login');




Route::get('/register', [UserAuthController::class, 'registerIndex'])->name('registerIndex');
Route::post('/register', [UserAuthController::class, 'register'])->name('register');

Route::get('/forgot-password', [AuthController::class, 'forgotPasswordIndex'])->name('forgotPasswordIndex');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword']);
Route::post('/reset-password', [AuthController::class, 'storeResetPassword'])->name('resetPassowrd');




Route::prefix('Admin-Online-Avenue')->middleware(['admin'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('AdminDashboard');
    //owner
    Route::get('/show-owner', [OwnerController::class, 'index'])->name('showOwner');
    Route::delete('show-owner/{id}/edit-owner', [OwnerController::class, 'destroy'])->name('deleteOwner');
    Route::get('show-owner/{id}/edit-owner', [OwnerController::class, 'edit']);
    Route::put('show-owner/{id}/edit-owner', [OwnerController::class, 'update'])->name('updateOwner');
    Route::get('create-owner', [OwnerController::class, 'create'])->name('showCreateOwner');
    Route::post('create-owner', [OwnerController::class, 'store'])->name('createOwner');
    //reservation
    Route::get('/show-reservation', [BookingController::class, 'index'])->name('showReservation');
    Route::get('show-reservation/{id}/datail-reservation', [BookingController::class, 'detailsBooking']);
    Route::delete('show-reservation/{id}/edit-reservation', [BookingController::class, 'destroy'])->name('deleteReservation');
    Route::get('show-reservation/{id}/print-invoice', [BookingController::class, 'printinvoice'])->name('printinvoice');
    //avenue
    Route::get('/show-avenue', [AvenueController::class, 'index'])->name('showAvenue');
    Route::get('create-avenue', [AvenueController::class, 'create'])->name('showCreateAvenue');
    Route::post('create-avenue', [AvenueController::class, 'store'])->name('createAvenue');
    Route::delete('show-avenue/{id}/edit-avenue', [AvenueController::class, 'destroy'])->name('deleteAvenue');
    Route::get('show-avenue/{id}/edit-avenue', [AvenueController::class, 'edit']);
    Route::put('show-avenue/{id}/edit-avenue', [AvenueController::class, 'update'])->name('updateAvenue');
    


});    


Route::get('/login-customer', [UserAuthController::class, 'index'])->name('customerloginIndex');
Route::post('/login-customer', [UserAuthController::class, 'customerLogin'])->name('customerLogin');


Route::prefix('Customer-Online-Avenue')->middleware(['customers'])->group(function () {
    //login
    Route::get('logout', [UserAuthController::class,'logout'])->name('customerLogout');
        Route::get('/index', [indexController::class,'Index'])->name('home');
        //profile
        Route::get('/profile/{id}',[profileController::class,'info'])->name('profile');
        Route::patch('/profile/{id}',[profileController::class,'update'])->name('updateProfile');
        Route::delete('/profile/{id}',[profileController::class,'destroy'])->name('deleteProfile');
        Route::get('/avenue/{id}', [AvenueController::class, 'show'])->name('show');
    });
    
    