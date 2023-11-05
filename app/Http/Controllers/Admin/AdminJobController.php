<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobStatusEmail;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use Storage;
use App\Models\Job;
use App\Models\Employer;
use Carbon\Carbon;

class AdminJobController extends Controller
{
    public function getJobs() {
        $jobs = Job::with('employer')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('admin.jobs', compact('jobs'));
    }

    public function getJobsById(Request $request) {
        $jobs = Job::where('id', $request->id)
                ->with('employer')
                ->first();
                
        return response()->json($jobs);
    }

    public function updateJob(Request $request) {
        $closed_at = NULL;

        if ($request->status == 0) {
            $closed_at = date('Y-m-d H:i:s');
        }

        $job = Job::where('id', (int)$request->id);
        $job->update([
                'status' => (int)$request->status, // 0 - inactive, 1 - active, 2 - disabled
                'closed_at' => $closed_at,
        ]);

        $jb = $job->with('employer')->first();
        Mail::to($jb->employer['email'])
            ->send(new JobStatusEmail(
                $jb->first()
            )
        );

        if ($job) {
            return response()->json([
                'message' => 'Job updated successfully',
                'code'    => '200'
            ]);
        }

    }

}
