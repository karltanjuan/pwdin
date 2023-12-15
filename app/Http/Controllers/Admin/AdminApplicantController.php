<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicantStatusEmail;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use App\Models\User;
use App\Models\Application;
use Carbon\Carbon;

class AdminApplicantController extends Controller
{
    public function getApplicants($status = "all") {
        $applicants = User::when($status === 'approved', function ($query) {
            return $query->where('status', 1);
        })->when($status === 'pending', function ($query) {
            return $query->where('status', 0);
        })->when($status === 'rejected', function ($query) {
            return $query->where('status', 2);
        });
        
        $applicants = $applicants->orderBy('created_at', 'desc')
                      ->get();
                      
        return view('admin.applicants', compact('applicants'));
    }

    public function getApplications($status) {
        $applicants = Application::with('applicant', 'job', 'job.employer')
            ->when($status === 'hired', function ($query) {
                return $query->where('status', 'Hired')->where('is_rejected', 0);
            })->when($status === 'rejected', function ($query) {
                return $query->where('is_rejected', 1);
            })
            ->orderBy('created_at', 'desc')->get();
               
        if (count($applicants) === 0) {
            return redirect('/admin/applicants');
        }
        
        return view('admin.applications', compact('applicants'));
    }

    public function getApplicantById(Request $request) {
        $applicants = User::where('id', (int)$request->id)->first();
        return response()->json($applicants);
    }

    public function updateApplicantApproval(Request $request){
        $applicant = User::where('id', (int)$request->id);
        $applicant->update([
            'status' => $request->status // 0 - pending, 1 - approved, 2 - rejected
        ]);

        $app = $applicant->first();
        Mail::to($app['email'])
            ->send(new ApplicantStatusEmail(
                $applicant->first()
            )
        );

        if ($applicant) {
            return response()->json([
                'message' => 'Applicant status updated successfully',
                'code'    => '200'
            ]);
        }
    }

}
