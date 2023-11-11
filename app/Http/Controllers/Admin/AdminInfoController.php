<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use Hash;
use App\Models\Admin;
use Carbon\Carbon;


class AdminInfoController extends Controller
{
    public function getAdminInfo() {
        return view('admin.admin-info');
    }

    public function updateAdminInfo(Request $request) {
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
            $profile_path = $request->file('profile_photo')->storeAs('public/admin/profile_photo', $profile_path);

            $old_file = $request->input('old_file');
            if ($old_file) {
                Storage::delete($old_file);
            }
        }

        $admin_data = [
            'username'        => $request->username,
            'email'           => $request->email,
            'mobile_no'       => $request->mobile_no,
            'first_name'      => $request->first_name,
            'middle_name'     => $request->middle_name,
            'last_name'       => $request->last_name,
            'prefix'          => $request->prefix,
        ];

        if (!empty($profile_path)) {
            $admin_data['profile_photo'] =  $profile_path;
        }
   
        $user = Admin::where('id', auth()->guard('admins')->user()->id)
                ->update($admin_data);
        
        return response()->json([
            'message' => 'Admin information updated successfully',
            'code'    => '200'
        ]);
    }

    public function validateProfile(Request $request) {
        $id = auth()->guard('admins')->user()->id;

        return Validator::make($request->all(), [
            // 'profile_photo'         => 'required|mimes:jpeg,jpg,png',
            'username'              => 'required|unique:users,username,'.$id,
            'email'                 => 'required|email|unique:users,email,'.$id,
            'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
            'first_name'            => 'required|min:2',
            'middle_name'           => 'nullable|min:2',
            'last_name'             => 'required|min:2',
            'prefix'                => 'nullable|min:2',
        ]);
    }
}
