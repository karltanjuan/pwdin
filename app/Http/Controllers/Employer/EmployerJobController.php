<?php

namespace App\Http\Controllers\Employer;

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


class EmployerJobController extends Controller
{
    public function index() {
        return view('employer.jobs');
    }

    public function postJob(Request $request){

        $validator = $this->validateJob($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // save to database
        $job = new Job();
        $job->employer_id               = auth()->guard('employers')->user()->id; //the employer na nakalogin
        $job->job_title                 = $request->job_title; 
        $job->career_level              = $request->career_level; 
        $job->job_type                  = $request->job_type; 
        $job->job_industry              = $request->job_industry; 
        $job->years_experience          = $request->years_experience; 
        $job->average_processing_time   = $request->average_processing_time; 
        $job->salary                    = $request->salary; 
        $job->qualification             = $request->qualification; 
        $job->work_setup                = $request->work_setup; 
        $job->working_days              = $request->working_days;
        $job->job_description           = $request->job_description; 
        $job->status                    = 1; // 0 - inactive, 1 - active
        $job->save();

        if ($job) { // When user save on database successfully
            return response()->json([
                'message' => 'Job created created successfully',
                'code'    => '200'
            ]);
        }

    }

    public function validateJob($request) {
         $rules = [
            'job_title'                 => 'required|string',
            'job_description'           => 'required|string',
            'career_level'              => 'required|string',
            'job_type'                  => 'required|string',
            'job_industry'              => 'required|string',
            'years_experience'          => 'required|numeric',
            'average_processing_time'   => 'required|string',
            'salary'                    => 'required|numeric',
            'qualification'             => 'required|string',
            'work_setup'                => 'required|string',
            'working_days'              => 'required|string',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }
}
