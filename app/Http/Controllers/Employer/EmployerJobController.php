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

    public function postJob(Request $request)
    {       
        $validator = $this->validateJob($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }


        // save to database
        $user = new Employer();
        $user->username        = $request->username; // validate must be unique
        $user->email           = $request->email; // validate must be unique
        $user->password        = bcrypt($request->password); // must be minimum 8 alphanumeric character with special symbol with capital and small character, validate with confirm password
        $user->contact_person  = $request->contact_person; // required
        $user->mobile_no       = $request->mobile_no; // starts with 09#########, must be 12 digit
        $user->company_name    = $request->company_name; // required
        $user->address         = $request->address; // required
        $user->province        = $request->province; // required
        $user->city            = $request->city; // required
        $user->summary         = $request->summary; // maximum 300 words
        $user->zip_code        = $request->zip_code; // validated as 4 digit
        $user->company_logo    = $company_logo_path; // validate as jpg, jpeg or png
        $user->business_permit = $business_permit_path; // validate as pdf, jpg, jpeg, or png
        $user->bir_certificate = $bir_certificate_path; // validate as pdf, jpg, jpeg, or png
        $user->status          = 0; // 0 - inactive, 1 - active, 2 - deleted
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
            'job_title'             => 'required|',
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
