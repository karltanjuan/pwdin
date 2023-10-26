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

class ApplicantJobController extends Controller
{
    public function index($type = null, $related = 'related') {
        $pwd_categories = auth()->user()->pwd_categories;
        $pwd_categories_arr = explode(',', $pwd_categories);

        $jobs = Job::orderBy('created_at', 'desc')
                    ->with('employer')
                    ->with(['applications' => function ($query) {
                        $query->where('applicant_id', auth()->user()->id);
                    }])
                    ->where('status', 1);

        $jobs = $type !== null ? $jobs->where('job_type', ucwords($type)) : $jobs;


        if ($related == "related") {
            // related pwd categories
            $jobs = $jobs->where(function ($query) use ($pwd_categories_arr) {
                foreach ($pwd_categories_arr as $category) {
                    $query->orWhere('pwd_categories', 'LIKE', "%$category%");
                }
            })->get();
        } else {
            // all pwd categories
            $jobs = $jobs->get();
        }
                    
        return view('applicant.jobs', compact('jobs'));
    }

    public function getJobs(Request $request) {
        
        $request->related = $request->related ?? "related";

        if ($request->type == 'null') {
            $request->type = null;
        }

        if ($request->search_query == 'null') {
            $request->search_query = null;
        }

        $pwd_categories = auth()->user()->pwd_categories;
        $pwd_categories_arr = explode(',', $pwd_categories);

        $jobs = Job::orderBy('created_at', 'desc')
                    ->with('employer')
                    ->with(['applications' => function ($query) {
                        $query->where('applicant_id', auth()->user()->id);
                    }])
                    ->where('status', 1);
        
        $jobs = $request->type !== null ? $jobs->where('job_type', ucwords($request->type)) : $jobs;
        $jobs = $request->search_query !== null ? $jobs->where('job_title', 'like', '%'.$request->search_query.'%') : $jobs;

        if ($request->related == "related") {
            // related pwd categories
            $jobs = $jobs->where(function ($query) use ($pwd_categories_arr) {
                foreach ($pwd_categories_arr as $category) {
                    $query->orWhere('pwd_categories', 'LIKE', "%$category%");
                }
            })->get();
        } else {
            // all pwd categories
            $jobs = $jobs->get();
        }
                    
        return response()->json($jobs);
    }

    public function getJobsById(Request $request) {
        $id = (int)$request->id;
        // Laravel Eloquent - handles database queries using OOP
        $job = Job::where('id', $id)
                    ->with('employer')
                    ->with(['applications' => function ($query) use ($id) {
                        $query->where('job_id', $id)
                              ->where('applicant_id', auth()->user()->id);
                    }])
                    ->first();

        return response()->json($job);
    }

    public function applyJob(Request $request){

        $validator = $this->validateApplication($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // save to database
        $application = new Application();
        $application->applicant_id = auth()->user()->id; 
        $application->job_id       = $request->job_id;
        $application->cover_letter = $request->cover_letter; 
        $application->status       = config('application.status')[0];
        $application->is_rejected  = 0;
        $application->rejected_reason = "";
        $application->save();

        if ($application) {
            return response()->json([
                'message' => 'Application created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function withdrawJob(Request $request) {
        $job_id = (int) $request->job_id;

        $application = Application::where([
            'job_id'       => $job_id,
            'applicant_id' => auth()->user()->id
        ])->update(['status' => 'Withdrawn']);

        if ($application) {
            return response()->json([
                'message' => 'Application withdraw successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateApplication($request) {
         $rules = [
            'cover_letter' => 'required|string|max:300',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }
}