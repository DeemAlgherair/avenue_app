<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AvenueController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\ReviewsController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;

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
    Route::put('/confirmed-bookings/{id}', [BookingController::class, 'confiremdBooking'])->name('confiremdBooking');
    Route::delete('show-reservation/{id}/edit-reservation', [BookingController::class, 'destroy'])->name('deleteReservation');
    Route::get('show-reservation/{id}/print-invoice', [BookingController::class, 'printinvoice'])->name('printinvoice');
    Route::get('/search-reservations', [BookingController::class, 'search'])->name('searchReservations');

    //avenue
    Route::get('/show-avenue', [AvenueController::class, 'index'])->name('showAvenue');
    Route::get('/create-avenue/{owner_id}', [AvenueController::class, 'create'])->name('showCreateAvenue');
    Route::post('/create-avenue/{owner_id}', [AvenueController::class, 'store'])->name('createAvenue');
    Route::delete('show-avenue/{id}/edit-avenue', [AvenueController::class, 'destroy'])->name('deleteAvenue');
    Route::get('show-avenue/{id}/edit-avenue', [AvenueController::class, 'edit']);
    Route::put('show-avenue/{id}/edit-avenue', [AvenueController::class, 'update'])->name('updateAvenue');
    Route::delete('/images', [AvenueController::class, 'removeImage'])->name('deleteImage');

    Route::post('/add-image/{id}', [AvenueController::class, 'addImage'])->name('addImage');


    //profile
    Route::get('/profile', [profileController::class, 'adminIndex']);
    Route::put('/profile', [profileController::class, 'adminUpdateProfile'])->name('adminUpdateProfile');
    //search 
    Route::get('/search-owner', [OwnerController::class, 'search'])->name('searchOwner');
Route::get('/search-avenue', [AvenueController::class, 'search'])->name('searchAvenue');   
});    


Route::get('/login-customer', [UserAuthController::class, 'index'])->name('customerloginIndex');
Route::post('/login-customer', [UserAuthController::class, 'customerLogin'])->name('customerLogin');

Route::get('/index', [indexController::class,'Index'])->name('home');

Route::get('/all-avenus',[CustomerController::class, 'all'])->name('all.avenues');
Route::get('/all-avenus/filter', [CustomerController::class, 'filter'])->name('filterAvenues');

Route::prefix('Customer-Online-Avenue')->middleware(['customers'])->group(function () {
    //login
    Route::get('logout', [UserAuthController::class,'logout'])->name('customerLogout');
        //profile
        Route::get('/profile/{id}',[profileController::class,'info'])->name('profile');
        Route::put('/profile/{id}',[profileController::class,'update'])->name('updateProfile');
        Route::delete('/profile/{id}',[profileController::class,'destroy'])->name('deleteProfile');
        //avenue
        Route::get('/avenue/{id}', [AvenueController::class, 'show'])->name('show');

        //Booking
        Route::get('/booking/{avenueId}', [BookingController::class, 'show'])->name('booking');
        Route::post('/booking/{avenueId}', [BookingController::class, 'store'])->name('bookings.store');
        //review 
        Route::get('/avenue/{id}/sort', [ReviewsController::class, 'sortReviews'])->name('sortReviews');

        //invoce
        Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
        //payment
        Route::get('/payment/{bookingId}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
        Route::post('/payment/{booking}', [PaymentController::class, 'processPayment'])->name('payment.process');
        Route::get('/payment/{booking}/callback',[PaymentController::class, 'callback'])->name('payment.callback');
        Route::put('/booking/{id}/update-status', [BookingController::class, 'updateStatus'])->name('updateBookingStatus');

        // confirmed booking
        Route::get('/all-bookings', [BookingController::class, 'showConfirmedBookings'])->name('confirmed.bookings');
        Route::get('/review-booking/{bookingId}', [BookingController::class, 'reviewBooking'])->name('review.booking');
        Route::post('/submit-review/{bookingId}', [BookingController::class, 'submitReview'])->name('review.submit');
        Route::get('/unconfirmed-bookings', [BookingController::class, 'showUnconfirmedBookings'])->name('unconfirmed.bookings');
        Route::get('/booking-success',[BookingController::class, 'success'])->name('bookings.success');
        Route::put('/booking/{id}/update-status', [BookingController::class, 'updateStatus'])->name('updateBookingStatus');


Route::get('/avenue/{id}/sort', [ReviewsController::class, 'sortReviews'])->name('sortReviews');
 });
    

    