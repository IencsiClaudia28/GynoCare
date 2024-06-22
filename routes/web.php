<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ClinicReviewController;
use App\Http\Controllers\PaymentValidationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/logout', [LogoutController::class, 'perform'])->name('logout');

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'admin']
    ],
    function() {
        //home route
        Route::get('/', [HomeController::class, 'index'])->name('home');

        //user routes
        Route::get('/users/create', [UserController::class, 'create'])->name('userCreate');
        Route::post('/users', [UserController::class, 'store'])->name('userStore');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('userEdit');
        Route::patch('/users/{id}', [UserController::class, 'update'])->name('userUpdate');
        Route::get('/users', [UserController::class, 'index'])->name('userIndex');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('userShow');

        //clinic routes
        Route::get('/clinics/create', [ClinicController::class, 'create'])->name('clinicCreate');
        Route::post('/clinics', [ClinicController::class, 'store'])->name('clinicStore');
        Route::get('/clinics/{id}/edit', [ClinicController::class, 'edit'])->name('clinicEdit');
        Route::patch('/clinics/{id}', [ClinicController::class, 'update'])->name('clinicUpdate');
        Route::get('/clinics', [ClinicController::class, 'index'])->name('clinicIndex');
        Route::get('/clinics/{id}', [ClinicController::class, 'show'])->name('clinicShow');

        //ticket routes
        Route::patch('/tickets/{id}', [TicketController::class, 'update'])->name('ticketUpdate');
        Route::get('/tickets', [TicketController::class, 'index'])->name('ticketIndex');
        Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('ticketShow');

        //appointment routes
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointmentIndex');
        Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointmentShow');

        //payment routes
        Route::get('/payments', [PaymentController::class, 'index'])->name('paymentIndex');
        Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('paymentShow');
        Route::post('/payments/{id}/refund', [PaymentController::class, 'refund'])->name('paymentRefund');
    }
);

Route::group(
    [
        'middleware' => ['auth']
    ],
    function() {
        Route::get('/clinics/{id}/reviews', [ClinicReviewController::class, 'index'])->name('clinicReviewsIndex');
    }
);

Route::group(
    [
        'middleware' => ['auth', 'nonAdmin']
    ],
    function() {
        //home route
        Route::get('/', [HomeController::class, 'index'])->name('home');

        //user routes
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('userEdit');
        Route::patch('/users/{id}', [UserController::class, 'update'])->name('userUpdate');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('userShow');

        //clinic routes
        Route::get('/clinics', [ClinicController::class, 'index'])->name('clinicIndex');
        Route::get('/clinics/{id}', [ClinicController::class, 'show'])->name('clinicShow');
        Route::get('/clinics/{id}/reviews/create', [ClinicReviewController::class, 'create'])->name('clinicReviewsCreate');
        Route::post('/clinics/reviews', [ClinicReviewController::class, 'store'])->name('clinicReviewsStore');
        Route::post('/clinics/{id}/subscribe', [ClinicController::class, 'subscribe'])->name('clinicSubscribe');
        Route::post('/clinics/{id}/unsubscribe', [ClinicController::class, 'unsubscribe'])->name('clinicUnsubscribe');

        //ticket routes
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticketCreate');
        Route::post('/tickets', [TicketController::class, 'store'])->name('ticketStore');
        Route::get('/tickets', [TicketController::class, 'index'])->name('ticketIndex');
        Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('ticketShow');

        //appointment routes
        Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointmentCreate');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointmentStore');
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointmentIndex');
        Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointmentShow');
        Route::post('/appointments/{id}/accept', [AppointmentController::class, 'accept'])->name('appointmentAccept');
        Route::post('/appointments/{id}/decline', [AppointmentController::class, 'decline'])->name('appointmentDecline');
        Route::post('/appointments/{id}/complete', [AppointmentController::class, 'complete'])->name('appointmentComplete');

        //payment routes
        Route::get('/payments', [PaymentController::class, 'index'])->name('paymentIndex');
        Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('paymentShow');
        Route::post('/payments/{id}/complete', [PaymentController::class, 'complete'])->name('paymentComplete');
    }
);

