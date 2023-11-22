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


class AdminUserController extends Controller
{
    public function getUsers() {
        $users = Admin::where('id', '!=', 1)
                 ->orderBy('created_at', 'desc')
                 ->get();

        return view('admin.users.index', compact('users'));
    }

    public function add() {
        return view('admin.users.add');
    }

    public function saveUser(Request $request) {
        $validator = $this->validateUser($request);

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
        }

        $user = new Admin();
        $user->profile_photo = $profile_path;
        $user->username      = $request->username;
        $user->email         = $request->email;
        $user->password      = Hash::make($request->password, ['rounds' => 12]);
        $user->mobile_no     = $request->mobile_no;
        $user->first_name    = $request->first_name;
        $user->middle_name   = $request->middle_name;
        $user->last_name     = $request->last_name;
        $user->prefix        = $request->prefix;
        $user->role          = $request->role; // admin
        $user->status        = $request->status;
        $user->save();

        if ($user) {
            return response()->json([
                'message' => 'User created successfully',
                'code'    => '200'
            ]);
        }
    }

    public function edit($id) {
        $user = Admin::where('id', (int)$id)->first();
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request) {
        $validator = $this->validateUserUpdate($request);

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
            'profile_photo' => $profile_path,
            'username'      => $request->username,
            'email'         => $request->email,
            'mobile_no'     => $request->mobile_no,
            'first_name'    => $request->first_name,
            'middle_name'   => $request->middle_name,
            'last_name'     => $request->last_name,
            'prefix'        => $request->prefix,
            'role'          => $request->role,
            'status'        => $request->status
        ];

        if (!empty($profile_path)) {
            $admin_data['profile_photo'] =  $profile_path;
        }


        $user = Admin::where('id', (int)$request->id)
                ->update($admin_data);

        if ($user) {
            return response()->json([
                'message' => 'User updated successfully',
                'code'    => '200'
            ]);
        }
    }

    public function deleteUser(Request $request){
        $id = (int) $request->id;
        $user = Admin::where('id', $id)->delete();

        if ($user) {
            return response()->json([
                'message' => 'User deleted successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateUser($request) {
         $rules = [
            'profile_photo'         => 'required|mimes:jpeg,jpg,png',
            'username'              => 'required|unique:users',
            'email'                 => 'required|email|unique:users',
            'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
            'password'              => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])[a-zA-Z0-9!@#$%^&*()_+]{8,}$/',
            'password_confirmation' => ['required', 'same:password'],
            'first_name'            => 'required|min:2',
            'middle_name'           => 'nullable|min:2',
            'last_name'             => 'required|min:2',
            'prefix'                => 'nullable|min:2',
            'role'                  => 'required',
            'status'                => 'required'
        ];

        return $validator = Validator::make($request->all(), $rules);
    }

    public function validateUserUpdate($request) {
        $rules = [
           'username'              => 'required|unique:users',
           'email'                 => 'required|email|unique:users',
           'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
           'first_name'            => 'required|min:2',
           'middle_name'           => 'nullable|min:2',
           'last_name'             => 'required|min:2',
           'prefix'                => 'nullable|min:2',
           'role'                  => 'required',
           'status'                => 'required'
       ];

       return $validator = Validator::make($request->all(), $rules);
   }

}
