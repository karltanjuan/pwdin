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
        return view('applicant.jobs');
    }

    public function getJobs(Request $request) { 
        $request->related = $request->related ?? "related";

        if ($request->type == 'null') {
            $request->type = null;
        }

        if ($request->industry == 'null') {
            $request->industry = null;
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
        $jobs = $request->industry !== null ? $jobs->where('job_industry', ucwords($request->industry)) : $jobs;
        $jobs = $request->salary_start !== null ? $jobs->where('salary', '>=', $request->salary_start)->where('hide_salary', 0) : $jobs;
        $jobs = $request->salary_end !== null ? $jobs->where('salary', '<=', $request->salary_end)->where('hide_salary', 0) : $jobs;

        $jobs = $request->search_query !== null ? $jobs->where('job_title', 'like', '%'.$request->search_query.'%') : $jobs;

        if ($request->related == "related") {
            // related pwd categories
            $jobs = $jobs->where(function ($query) use ($pwd_categories_arr) {
                foreach ($pwd_categories_arr as $category) {
                    $query->orWhere('pwd_categories', 'LIKE', "%$category%");
                }
            })->paginate(10);
        } else {
            // all pwd categories
            $jobs = $jobs->paginate(10);
        }
        
        return response()->json($jobs);
    }

    public function getJobsById($id) {
        $id = (int)$id;

        $job = Job::where('id', $id)
                    ->with('employer')
                    ->with(['applications' => function ($query) use ($id) {
                        $query->where('job_id', $id)
                              ->where('applicant_id', auth()->user()->id);
                    }])
                    ->first();

        if (!isset($job)) {
            return redirect('/applicant/jobs');
        }
        
        return view('applicant.job-details', compact('job'));
        // return response()->json($job);
    }

    public function applyJob(Request $request){

        $validator = $this->validateApplication($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $application_data = [
            'applicant_id'    => auth()->user()->id,
            'job_id'          => $request->job_id,
            'cover_letter'    => $request->cover_letter,
            'status'          => config('application.status')[0],
            'is_rejected'     => 0,
            'rejected_reason' => ""
        ];
        
        $application = Application::updateOrCreate(
            [
                'job_id'       => $request->job_id,
                'applicant_id' => auth()->user()->id
            ],
            $application_data
        );

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
            'cover_letter' => 'required|string|max:2000',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }
}