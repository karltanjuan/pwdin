<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use App\Models\User;
use Carbon\Carbon;


class ApplicantDashboardController extends Controller
{
    public function index() {
        return view('applicant.dashboard');
    }
}
