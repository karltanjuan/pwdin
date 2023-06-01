<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingApplicantEmail;
use Validator;
use Session;
use Storage;
use Auth;
use Hash;
use App\Models\User;
use Carbon\Carbon;


class EmployerAuthController extends Controller
{

    public function getRegister()
    {
        if (auth()->check()) {
            // return redirect('applicant/dashboard');
        }

        return view('employer.register');
    }

    };
