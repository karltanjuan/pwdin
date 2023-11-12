<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use Hash;
use App\Models\Employer;
use Carbon\Carbon;


class EmployerPasswordController extends Controller
{
    public function getChangePassword() {
        return view('employer.change-password');
    }

    public function updatePassword(Request $request) {

        $user = Employer::where('id', auth()->guard('employers')->user()->id)->first();

        if ($user && !Hash::check($request->current_password, $user->password)) {
             return response()->json([
                'errors' => [
                    'current_password' => ['The current password does not match.']
                ],
            ], 422);
        }
        
        $validator = $this->validatePasswordChange($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
   
        $user = Employer::where('id', auth()->guard('employers')->user()->id)
                ->update([
                    'password' => Hash::make($request->new_password, ['rounds' => 12]),
                ]);


        // Send email to nofify user that password changed
        
        return response()->json([
            'message' => 'Password updated successfully',
            'code'    => '200'
        ]);
    }

    public function validatePasswordChange(Request $request) {
        return Validator::make($request->all(), [
            'current_password'      => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[!@#$%^&*()_+=-~]/'],
            'new_password'          => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[!@#$%^&*()_+=-~]/'],
            'password_confirmation' => ['required', 'same:new_password']
        ]);
    }
}
