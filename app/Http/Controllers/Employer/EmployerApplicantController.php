<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusEmail;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use Storage;
use App\Models\Job;
use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;

class EmployerApplicantController extends Controller
{
    public function getApplicants($status = "all") {
        $employer = auth()->guard('employers')->user();
        
        $applicants = Application::whereHas('job', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id);
        });

        $applicants = $applicants->when($status === 'hired', function ($query) {
            return $query->where('status', 'Hired');
        })->when($status === 'rejected', function ($query) {
            return $query->where('status', 'Rejected');
        });


        $applicants = $applicants->with(['applicant', 'job'])
            ->orderByDesc('created_at')
            ->get();
    
        if ($applicants->isEmpty()) {
            return redirect('/employer/jobs');
        }
    
        return view('employer.applicants', compact('applicants'));
    }
}