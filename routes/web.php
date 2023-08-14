<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Applicant\AuthController;
use App\Http\Controllers\Applicant\ApplicantDashboardController;
use App\Http\Controllers\Applicant\ApplicantJobController;
use App\Http\Controllers\Applicant\ApplicantPasswordController;
use App\Http\Controllers\Applicant\ApplicantPWDCardController;
use App\Http\Controllers\Employer\EmployerAuthController;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Employer\EmployerJobController;
use App\Http\Controllers\Employer\ApplicationStatusController;
use App\Http\Controllers\Admin\AdminAuthController;

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

    Route::get('forgot-password', [AuthController::class, 'getForgotPassword'])->name('applicant.getForgotPassword');
    Route::post('postForgotPassword', [AuthController::class, 'postForgotPassword'])->name('applicant.postForgotPassword');

    Route::get('reset-password', [AuthController::class, 'getResetPassword'])->name('applicant.getResetPassword');
    Route::post('postResetPassword', [AuthController::class, 'postResetPassword'])->name('applicant.postResetPassword');

    Route::middleware('is_applicant')->group(function () {
        Route::get('/dashboard', [ApplicantDashboardController::class, 'index'])->name('applicant.dashboard');

        Route::get('/jobs', [ApplicantJobController::class, 'index'])->name('applicant.index');
        Route::post('getJobsById', [ApplicantJobController::class, 'getJobsById'])->name('applicant.getJobsById');

        Route::post('applyJob', [ApplicantJobController::class, 'applyJob'])->name('applicant.applyJob');

        Route::post('withdrawJob', [ApplicantJobController::class, 'withdrawJob'])->name('applicant.withdrawJob');

        Route::get('/pwd-card', [ApplicantPWDCardController::class, 'getChangePWDCard'])->name('applicant.getChangePWDCard');
        Route::post('/update-pwd-card', [ApplicantPWDCardController::class, 'updatePWDCard'])->name('applicant.updatePWDCard');


        Route::get('/change-password', [ApplicantPasswordController::class, 'getChangePassword'])->name('applicant.getChangePassword');
        Route::post('/update-password', [ApplicantPasswordController::class, 'updatePassword'])->name('applicant.updatePassword');

        Route::get('logout', [AuthController::class, 'logout'])->name('applicant.logout');
    });
});

// Employer
Route::group(['prefix' => 'employer'], function() { 

    Route::get('login', [EmployerAuthController::class, 'getLogin'])->name('employer.getLogin');
    Route::post('postLogin', [EmployerAuthController::class, 'postLogin'])->name('employer.postLogin');

    Route::get('register', [EmployerAuthController::class, 'getRegister'])->name('employer.getRegister');
    Route::post('postRegister', [EmployerAuthController::class, 'postRegister'])->name('employer.postRegister');

    Route::middleware('is_employer')->group(function () {
        Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('employer.dashboard');

        Route::get('/jobs', [EmployerJobController::class, 'index'])->name('employer.index');

        Route::post('postJob', [EmployerJobController::class, 'postJob'])->name('employer.postJob');
        Route::post('getJobsById', [EmployerJobController::class, 'getJobsById'])->name('employer.getJobsById');
        Route::post('updateJob', [EmployerJobController::class, 'updateJob'])->name('employer.updateJob');
        Route::post('deleteJob', [EmployerJobController::class, 'deleteJob'])->name('employer.deleteJob');

        Route::get('/application-status', [ApplicationStatusController::class, 'index'])->name('employer.applicationStatus');

        Route::post('saveAppStatus', [ApplicationStatusController::class, 'saveAppStatus'])->name('employer.saveAppStatus');
          Route::post('getAppStatusByName', [ApplicationStatusController::class, 'getAppStatusByName'])->name('employer.getAppStatusByName');
        Route::post('deleteAppStatus', [ApplicationStatusController::class, 'deleteAppStatus'])->name('employer.deleteAppStatus');

        Route::get('/jobs/{id}/applicants', [EmployerJobController::class, 'getApplicants'])->name('employer.getApplicants'); // dynamic id

        Route::post('getAppStatus', [EmployerJobController::class, 'getAppStatus'])->name('employer.getAppStatus');

        Route::post('getApplicantById', [EmployerJobController::class, 'getApplicantById'])->name('employer.getApplicantById');

        Route::post('updateAppStatus', [EmployerJobController::class, 'updateAppStatus'])->name('employer.updateAppStatus');

        Route::get('logout', [EmployerAuthController::class, 'logout'])->name('employer.logout');
    });
});

// Admin/Moderator
Route::group(['prefix' => 'admin'], function() {
    Route::get('register', [AdminAuthController::class, 'getRegister'])->name('admin.getRegister');
    Route::post('postRegister', [AdminAuthController::class, 'postRegister'])->name('admin.postRegister');
    
    Route::get('login', [AdminAuthController::class, 'getLogin'])->name('admin.getLogin');
    Route::post('postLogin', [AdminAuthController::class, 'postLogin'])->name('admin.postLogin');

    Route::get('forgot-password', [AdminAuthController::class, 'getForgotPassword'])->name('admin.getForgotPassword');
    Route::post('postForgotPassword', [AdminAuthController::class, 'postForgotPassword'])->name('admin.postForgotPassword');

    Route::get('reset-password/{token}', [AdminAuthController::class, 'getResetPassword'])->name('admin.getResetPassword');
    Route::post('postResetPassword', [AdminAuthController::class, 'postResetPassword'])->name('admin.postResetPassword');

    Route::middleware('is_admin')->group(function () {
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        });

        Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
