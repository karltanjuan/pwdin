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
use Carbon\Carbon;

class AdminApplicantController extends Controller
{
    public function getApplicants() {
        $applicants = User::orderBy('created_at', 'desc')->get();
        return view('admin.applicants', compact('applicants'));
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
