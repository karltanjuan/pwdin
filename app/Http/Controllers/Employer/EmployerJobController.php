<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use App\Models\Employer;
use Carbon\Carbon;


class EmployerJobController extends Controller
{
    public function index() {
        return view('employer.jobs');
    }
}
