<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Applicant\AuthController;
use App\Http\Controllers\Applicant\ApplicantDashboardController;
use App\Http\Controllers\Applicant\ApplicantJobController;
use App\Http\Controllers\Applicant\ApplicantResumeController;
use App\Http\Controllers\Applicant\ApplicantPWDCardController;
use App\Http\Controllers\Applicant\ApplicantProfileInfoController;
use App\Http\Controllers\Applicant\ApplicantPasswordController;

use App\Http\Controllers\Employer\EmployerAuthController;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Employer\EmployerJobController;
use App\Http\Controllers\Employer\ApplicationStatusController;
use App\Http\Controllers\Employer\CompanyInfoController;
use App\Http\Controllers\Employer\EmployerPasswordController;
use App\Http\Controllers\Employer\BusinessPermitController;
use App\Http\Controllers\Employer\BIRCertificateController;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminEmployerController;
use App\Http\Controllers\Admin\AdminApplicantController;
use App\Http\Controllers\Admin\AdminInfoController;
use App\Http\Controllers\Admin\AdminPasswordController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBlogController;


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

// Generate all database seeder
Route::get('/generate-seeder', function () {
    if (!session()->has('seeder_executed')) {
        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
        session(['seeder_executed' => true]);
        dd('Seeder uploaded');
    } else {
        dd('Seeder already uploaded');
    }
});


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

    Route::get('reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('applicant.getResetPassword');
    Route::post('postResetPassword', [AuthController::class, 'postResetPassword'])->name('applicant.postResetPassword');

    Route::middleware('is_applicant')->group(function () {
        Route::get('/dashboard', [ApplicantDashboardController::class, 'index'])->name('applicant.dashboard');

        Route::get('/jobs', [ApplicantJobController::class, 'index'])->name('applicant.index');
        Route::post('getJobsById', [ApplicantJobController::class, 'getJobsById'])->name('applicant.getJobsById');

        Route::post('applyJob', [ApplicantJobController::class, 'applyJob'])->name('applicant.applyJob');

        Route::post('withdrawJob', [ApplicantJobController::class, 'withdrawJob'])->name('applicant.withdrawJob');

        Route::get('/profile-info', [ApplicantProfileInfoController::class, 'getProfileInfo'])->name('applicant.getProfileInfo');
        Route::post('/update-profile', [ApplicantProfileInfoController::class, 'updateProfileInfo'])->name('applicant.updateProfileInfo');

        Route::get('/resume', [ApplicantResumeController::class, 'getResume'])->name('applicant.getResume');
        Route::post('/update-resume', [ApplicantResumeController::class, 'updateResume'])->name('applicant.updateResume');

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


    Route::get('forgot-password', [EmployerAuthController::class, 'getForgotPassword'])->name('employer.getForgotPassword');
    Route::post('postForgotPassword', [EmployerAuthController::class, 'postForgotPassword'])->name('employer.postForgotPassword');

    Route::get('reset-password/{token}', [EmployerAuthController::class, 'getResetPassword'])->name('employer.getResetPassword');
    Route::post('postResetPassword', [EmployerAuthController::class, 'postResetPassword'])->name('employer.postResetPassword');

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

        Route::get('/company-info', [CompanyInfoController::class, 'getCompanyInfo'])->name('employer.getCompanyInfo');
        Route::post('/update-company', [CompanyInfoController::class, 'updateCompanyInfo'])->name('employer.updateCompanyInfo');

        Route::get('/business-permit', [BusinessPermitController::class, 'getBusinessPermit'])->name('employer.getBusinessPermit');
        Route::post('/update-business-permit', [BusinessPermitController::class, 'updateBusinessPermit'])->name('employer.updateBusinessPermit');

        Route::get('/bir-certificate', [BIRCertificateController::class, 'getBIRCertificate'])->name('employer.getBIRCertificate');
        Route::post('/update-bir-certificate', [BIRCertificateController::class, 'updateBIRCertificate'])->name('employer.updateBIRCertificate');

        Route::get('/change-password', [EmployerPasswordController::class, 'getChangePassword'])->name('employer.getChangePassword');
        Route::post('/update-password', [EmployerPasswordController::class, 'updatePassword'])->name('employer.updatePassword');

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
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/jobs', [AdminJobController::class, 'getJobs'])->name('admin.getJobs');
        Route::post('getJobsById', [AdminJobController::class, 'getJobsById'])->name('admin.getJobsById');
        Route::post('updateJob', [AdminJobController::class, 'updateJob'])->name('admin.updateJob');

        Route::get('/applicants', [AdminApplicantController::class, 'getApplicants'])->name('admin.getApplicants');
        Route::post('/getApplicantById', [AdminApplicantController::class, 'getApplicantById'])->name('admin.getApplicantById');
        Route::post('/updateApplicantApproval', [AdminApplicantController::class, 'updateApplicantApproval'])->name('admin.updateApplicantApproval');

        Route::get('/employers', [AdminEmployerController::class, 'getEmployers'])->name('admin.getEmployers');
        Route::post('/getEmployerById', [AdminEmployerController::class, 'getEmployerById'])->name('admin.getEmployerById');
        Route::post('/updateEmployerApproval', [AdminEmployerController::class, 'updateEmployerApproval'])->name('admin.updateEmployerApproval');

        Route::get('/profile-info', [AdminInfoController::class, 'getAdminInfo'])->name('admin.getAdminInfo');
        Route::post('/update-admin', [AdminInfoController::class, 'updateAdminInfo'])->name('admin.updateAdminInfo');

        Route::get('/change-password', [AdminPasswordController::class, 'getChangePassword'])->name('admin.getChangePassword');
        Route::post('/update-password', [AdminPasswordController::class, 'updatePassword'])->name('admin.updatePassword');

        Route::get('/users', [AdminUserController::class, 'getUsers'])->name('admin.getUsers');
        Route::post('/getUserById', [AdminUserController::class, 'getUserById'])->name('admin.getUserById');
        Route::post('saveUser', [AdminUserController::class, 'saveUser'])->name('admin.saveUser');
        Route::post('updateUser', [AdminUserController::class, 'updateUser'])->name('admin.updateUser');
        Route::post('deleteUser', [AdminUserController::class, 'deleteUser'])->name('admin.deleteUser');

        Route::get('/blogs', [AdminBlogController::class, 'getBlogs'])->name('admin.getBlogs');
        Route::post('/getBlogById', [AdminBlogController::class, 'getBlogById'])->name('admin.getBlogById');
        Route::post('saveBlog', [AdminBlogController::class, 'saveBlog'])->name('admin.saveBlog');
        Route::post('updateBlog', [AdminBlogController::class, 'updateBlog'])->name('admin.updateBlog');
        Route::post('deleteBlog', [AdminBlogController::class, 'deleteBlog'])->name('admin.deleteBlog');

        Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
