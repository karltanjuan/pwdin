<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use Storage;
use App\Models\Job;
use Carbon\Carbon;


class ApplicantJobController extends Controller
{
    public function index() {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return view('applicant.jobs', compact('jobs'));
    }

    public function getJobsById(Request $request) {
        $jobs = Job::where('id', $request->id)->first();
        return response()->json($jobs);
    }
}
