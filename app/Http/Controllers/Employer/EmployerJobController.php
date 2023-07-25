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

    public function postJob(Request $request){      
        $validator = $this->validateJob($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }


        // save to database
        $user = new Job();
        $user->username        = $request->username; // validate must be unique
        $user->email           = $request->email; // validate must be unique
        $user->status          = 1; // 0 - inactive, 1 - active, 2 - deleted
        $user->save();

        if ($user) { // When user save on database successfully
            return response()->json([
                'message' => 'Job created created successfully',
                'code'    => '200'
            ]);
        }

    }

    public function validateJob($request) {
        $rules = [
            'job_title'             => 'required',
            'job_description'       => 'required',
            'job_title'	=> 'required',
        	'career_level'	=> 'required',
        	'job_type'	=> 'required',
        	'job_industry'	=> 'required',
        	'years_experience'	=> 'required',
        	'average_processing_time'	=> 'required',
        	'salary'	=> 'required',
        	'qualification'	=> 'required',
        	'work_setup'	=> 'required',
        	'working_days'	=> 'required',
        	'job_description'	=> 'required',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }
}
