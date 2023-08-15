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

        $profile_file = null;
        $profile_path = "";
        if ($request->file('profile_photo')) {
            $profile_file = $request->file('profile_photo');
            $profile_path = uniqid().md5(1).'_'.$profile_file->getClientOriginalName();
            $profile_path = $request->file('profile_photo')->storeAs('public/applicant/profile_photo', $profile_path);

            $old_file = $request->input('old_file');
            if ($old_file) {
                Storage::delete($old_file);
            }
        }
   
        $user = User::where('id', auth()->user()->id)
                ->update([
                     'profile_photo'   => $profile_path,
                     'username'        => $request->username,
                     'email'           => $request->email,
                     'first_name'      => $request->first_name,
                     'middle_name'     => $request->middle_name,
                     'last_name'       => $request->last_name,
                     'prefix'          => $request->prefix,
                     'birthdate'       => $request->birthdate,
                     'gender'          => $request->gender,
                     'mobile_no'       => $request->mobile_no,
                     'education_level' => $request->education_level,
                     'address'         => $request->address,
                     'province'        => $request->province,
                     'city'            => $request->city,
                     'summary'         => $request->summary,
                     'zip_code'        => $request->zip_code,
                     'pwd_categories'  => $request->pwd_categories,
                ]);
        
        return response()->json([
            'message' => 'Profile information updated successfully',
            'code'    => '200'
        ]);
    }

    public function validateProfile(Request $request) {
        $id = auth()->user()->id;

        return Validator::make($request->all(), [
            'username'              => 'required|unique:users,username,'.$id,
            'email'                 => 'required|email|unique:users,email,'.$id,
            'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
            'birthdate'             => 'required',
            'first_name'            => 'required|min:2',
            'middle_name'           => 'nullable|min:2',
            'last_name'             => 'required|min:2',
            'prefix'                => 'nullable|min:2',
            'gender'                => 'required',
            'education_level'       => 'required',
            'province'              => 'required|',
            'city'                  => 'required|',
            'address'               => 'required',
            'zip_code'              => 'required|digits:4',
            'profile_photo'         => 'required|mimes:jpeg,jpg,png',
            'pwd_categories'        => 'required'
        ]);
    }
}
