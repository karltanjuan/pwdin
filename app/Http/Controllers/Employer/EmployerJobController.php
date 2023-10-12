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
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;

class EmployerJobController extends Controller
{
    public function index() {
        $jobs = Job::orderBy('created_at', 'desc')
                ->with('applications')
                ->get();
        return view('employer.jobs', compact('jobs'));
    }

    public function getJobsById(Request $request) {
        $jobs = Job::where('id', $request->id)->first();
        return response()->json($jobs);
    }

    public function postJob(Request $request){

        $validator = $this->validateJob($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // save to database
        $job                          = new Job();
        $job->employer_id             = auth()->guard('employers')->user()->id;
        $job->job_title               = $request->job_title; 
        $job->career_level            = $request->career_level; 
        $job->job_type                = $request->job_type; 
        $job->job_industry            = $request->job_industry; 
        $job->years_experience        = $request->years_experience; 
        $job->average_processing_time = $request->average_processing_time; 
        $job->salary                  = $request->salary; 
        //gawa ni gail eyy
        $job->hide_salary             = $request->hide_salary;
        $job->qualification           = $request->qualification; 
        $job->work_setup              = $request->work_setup; 
        $job->working_days            = $request->working_days;
        $job->pwd_categories          = $request->pwd_categories;
        $job->job_description         = $request->job_description; 
        $job->status                  = $request->status; // 0 - inactive, 1 - active
        $job->save();

        if ($job) {
            return response()->json([
                'message' => 'Job created successfully',
                'code'    => '200'
            ]);
        }

    }

    public function updateJob(Request $request){
        
        $validator = $this->validateJob($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $hide_salary = ($request->hide_salary === "true") ? 1 : 0;

        // save to database
        $job = Job::where('id', $request->id);
        $job->update([
            'job_title'               => $request->job_title, 
            'career_level'            => $request->career_level,
            'job_type'                => $request->job_type, 
            'job_industry'            => $request->job_industry, 
            'years_experience'        => $request->years_experience, 
            'average_processing_time' => $request->average_processing_time, 
            'salary'                  => $request->salary,
            'hide_salary'             => $hide_salary, 
            'qualification'           => $request->qualification, 
            'work_setup'              => $request->work_setup, 
            'working_days'            => $request->working_days,
            'pwd_categories'          => $request->pwd_categories,
            'job_description'         => $request->job_description, 
            'status'                  => $request->status // 0 - inactive, 1 - active
        ]);

        if ($job) {
            return response()->json([
                'message' => 'Job updated successfully',
                'code'    => '200'
            ]);
        }

    }

    public function deleteJob(Request $request){
        $id = (int) $request->id;
        $job = Job::where('id', $id)->delete();

        if ($job) {
            return response()->json([
                'message' => 'Job deleted successfully',
                'code'    => '200'
            ]);
        }
    }

    public function getApplicants(int $id) {
        $applicants = Application::where('job_id', $id)
            ->with('applicant')
            ->with('job')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('employer.applicants', compact('applicants'));
    }

    public function getApplicantById(Request $request) {

        $applicants = Application::where('job_id', (int)$request->job_id)
            ->where('applicant_id', (int)$request->applicant_id)
            ->with('applicant')
            ->with('job')
            ->orderBy('created_at', 'desc')
            ->get();

        $app_status = ApplicationStatus::where('employer_id', auth()->guard('employers')->user()->id)->orderBy('id', 'asc')->get();

        $response = [
            'applicants' => $applicants,
            'app_status' => $app_status
        ];

        return response()->json($response);
    }

    public function getAppStatus() {
        $status = ApplicationStatus::where('employer_id', auth()->guard('employers')->user()->id)
                    ->orderBy('id', 'asc')
                    ->get();

        return response()->json($status);
    }


    public function updateAppStatus(Request $request){

        $update_data = [
            'status' => $request->status,
            'is_rejected' => (int)$request->is_rejected,
            'rejected_reason' => $request->rejected_reason ?? '',
        ];    

        if ($request->status == "Rejected") {
            $update_data = [
                'is_rejected' => (int)$request->is_rejected,
                'rejected_reason' => $request->rejected_reason ?? '',
            ];    
        }

        $application = Application::where('id', (int)$request->id);
        $application->update($update_data);

        if ($application) {
            return response()->json([
                'message' => 'Application updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateJob($request) {
         $rules = [
            'job_title'               => 'required|string',
            'job_description'         => 'required|string',
            'career_level'            => 'required|string',
            'job_type'                => 'required|string',
            'job_industry'            => 'required|string',
            'years_experience'        => 'required|numeric',
            'average_processing_time' => 'required|string',
            'salary'                  => 'required|numeric',
            'qualification'           => 'required|string',
            'work_setup'              => 'required|string',
            'working_days'            => 'required|string',
            'pwd_categories'          => 'required|string',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }
}
