<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use Hash;
use App\Models\User;
use Carbon\Carbon;


class ApplicantResumeController extends Controller
{
    public function getResume() {
        return view('applicant.resume');
    }

    public function updateResume(Request $request) {
        $validator = $this->validateResume($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $resume_file = null;
        $resume_path = "";
        if ($request->file('resume')) {
            $resume_file = $request->file('resume');
            $resume_path = uniqid().md5(1).'_'.$resume_file->getClientOriginalName();
            $resume_path = $request->file('resume')->storeAs('public/applicant/resume', $resume_path);

            $old_file = $request->input('old_file');
            if ($old_file) {
                Storage::delete($old_file);
            }
        }
   
        $user = User::where('id', auth()->user()->id)
                ->update([
                    'resume' => $resume_path
                ]);
        
        return response()->json([
            'message' => 'PWD Card updated successfully',
            'code'    => '200'
        ]);
    }

    public function validateResume(Request $request) {
        return Validator::make($request->all(), [
            'resume' => 'required|mimes:pdf',
        ]);
    }
}
