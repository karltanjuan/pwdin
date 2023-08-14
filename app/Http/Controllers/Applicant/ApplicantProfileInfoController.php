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


class ApplicantProfileInfoController extends Controller
{
    public function getProfileInfo() {
        return view('applicant.profile-info');
    }

    public function updateProfileInfo(Request $request) {
        $validator = $this->validateProfile($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
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

    public function validateProfile(Request $request) {
        return Validator::make($request->all(), [
        ]);
    }
}
