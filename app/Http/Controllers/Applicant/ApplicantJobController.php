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
    public function index() {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return view('applicant.jobs', compact('jobs'));
    }

    public function getJobsById(Request $request) {
        $jobs = Job::where('id', $request->id)->first();
        return response()->json($jobs);
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
        $application->status       = 'Applied'; 
        $application->save();

        if ($application) {
            return response()->json([
                'message' => 'Application created successfully',
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
