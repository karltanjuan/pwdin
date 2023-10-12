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
use App\Models\Application;
use Carbon\Carbon;

class ApplicantAppliedJobController extends Controller
{
    public function getAppliedJobs() {
        $pwd_categories = auth()->user()->pwd_categories;
        $pwd_categories_arr = explode(',', $pwd_categories);

        $jobs = Job::orderBy('created_at', 'desc')
                    ->with(['employer' => function ($query) {
                        $query->with('application_statuses');
                    }])
                    ->whereHas('applications', function ($query) {
                        $query->where('applicant_id', auth()->user()->id);
                    })
                    // ->where(function ($query) use ($pwd_categories_arr) {
                    //     foreach ($pwd_categories_arr as $category) {
                    //         $query->orWhere('pwd_categories', 'LIKE', "%$category%");
                    //     }
                    // })
                    // ->where('status', 1)
                    ->get();

        return view('applicant.applied-jobs', compact('jobs'));
    }

    public function getAppliedJobsById(Request $request) {
        $id  = (int)$request->id;

        $job = Job::where('id', $id)
                    ->with('employer')
                    ->with(['applications' => function ($query) use ($id) {
                        $query->where('job_id', $id)
                              ->where('applicant_id', auth()->user()->id);
                    }])
                    ->first();

        return response()->json($job);
    }

}