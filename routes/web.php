<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Applicant\AuthController;
use App\Http\Controllers\Employer\EmployerAuthController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Applicant
/* prefix is use to reduce redudancy on the route url */
Route::group(['prefix' => 'applicant'], function() {
    Route::get('register', [AuthController::class, 'getRegister'])->name('applicant.getRegister');

    // submit data to backend using HTTP POST 
    Route::post('postRegister', [AuthController::class, 'postRegister'])->name('applicant.postRegister');

    Route::get('login', [AuthController::class, 'getLogin'])->name('applicant.getLogin');

    Route::post('postLogin', [AuthController::class, 'postLogin'])->name('applicant.postLogin');

    Route::middleware('is_applicant')->group(function () {
        Route::get('/dashboard', function() {
            return view('applicant.dashboard');
        });

        Route::get('logout', [AuthController::class, 'logout'])->name('applicant.logout');
    });
});

// Employer
Route::group(['prefix' => 'employer'], function() { 

    // Route::post('postLogin', [AuthController::class, 'postLogin'])->name('applicant.postLogin');

    Route::get('register', [EmployerAuthController::class, 'getRegister'])->name('employer.getRegister');

    // submit data to backend using HTTP POST 
    Route::post('postRegister', [EmployerAuthController::class, 'postRegister'])->name('employer.postRegister');
});
// Admin/Moderator
