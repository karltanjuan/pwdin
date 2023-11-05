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
    public function index() {
        // $pwd_categories = auth()->user()->pwd_categories;
        // $pwd_categories_arr = explode(',', $pwd_categories);

        // $jobs = Job::orderBy('created_at', 'desc')
        //             ->with(['employer' => function ($query) {
        //                 $query->with('application_statuses');
        //             }])
        //             ->whereHas('applications', function ($query) {
        //                 $query->where('applicant_id', auth()->user()->id);
        //             })
        //             ->get();

        // return view('applicant.applied-jobs', compact('jobs'));
        return view('applicant.applied-jobs');
    }

    public function postAppliedJobs(Request $request) {
        if ($request->search_query == 'null') {
            $request->search_query = null;
        }
        
        $jobs = Job::orderBy('created_at', 'desc')
            ->with(['employer' => function ($query) {
                $query->with('application_statuses');
            }])
            ->with(['applications' => function ($query) {
                $query->where('applicant_id', auth()->user()->id);
                $query->orderBy('created_at', 'desc');
            }])
            ->whereHas('applications', function ($query) {
                $query->where('applicant_id', auth()->user()->id);
                $query->orderBy('created_at', 'desc');
            })
            ->where('status', 1);
        
        $jobs = $jobs->when($request->search_query !== null, function ($query) use ($request) {
            return $query->where('job_title', 'like', '%' . $request->search_query . '%');
        })
        ->paginate(10);
        
        return response()->json($jobs);
        

    }

    public function getAppliedJobsById($id) {
        $id  = (int)$id;

        $job = Job::where('id', $id)
                    ->with('employer')
                    ->with(['applications' => function ($query) use ($id) {
                        $query->where('job_id', $id)
                              ->where('applicant_id', auth()->user()->id);
                    }])
                    ->first();

        return view('applicant.applied-job-details', compact('job'));
    }

}