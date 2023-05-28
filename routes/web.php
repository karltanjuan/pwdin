<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Applicant\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Applicant
/* prefix is use to reduce redudancy on the route url */
Route::group(['prefix' => 'applicant'], function() {

    // Route::post('postLogin', [AuthController::class, 'postLogin'])->name('applicant.postLogin');

    Route::get('register', [AuthController::class, 'getRegister'])->name('applicant.getRegister');

    // submit data to backend using HTTP POST 
    Route::post('postRegister', [AuthController::class, 'postRegister'])->name('applicant.postRegister');
});

// Employer

// Admin/Moderator
