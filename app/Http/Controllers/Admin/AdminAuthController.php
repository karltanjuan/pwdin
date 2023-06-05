<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use Session;
use Storage;
use Auth;
use Hash;
use App\Models\Admin;
use Carbon\Carbon;

class AdminAuthController extends Controller
{

    public function getRegister()
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.register');
    }


    public function postRegister(Request $request)
    {       
        $validator = $this->validateRegisterAdmin($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // profile_photo
        $profile_photo_file = null;
        $profile_photo_path = "";
        if ($request->file('profile_photo')) {
            $profile_photo_file = $request->file('profile_photo');
            $profile_photo_path = uniqid().md5(1).'_'.$profile_photo_file->getClientOriginalName();
            $profile_photo_path = $request->file('profile_photo')->storeAs('public/admin/profile_photo', $profile_photo_path);
        }

        // save to database
        $user                = new Admin();
        $user->username      = $request->username; // validate must be unique
        $user->email         = $request->email; // validate must be unique
        $user->password      = bcrypt($request->password); // must be minimum 8 alphanumeric character with special symbol with capital and small character, validate with confirm password
        $user->mobile_no     = $request->mobile_no; // starts with 09#########, must be 12 digit
        $user->first_name    = $request->first_name; // minimum of 2 character
        $user->middle_name   = $request->middle_name; // optional
        $user->last_name     = $request->last_name; // minimum of 2 character
        $user->prefix        = $request->prefix; // optional
        $user->profile_photo = $profile_photo_path; // validate as jpg, jpeg, or png
        $user->role          = $request->role; // 0 - inactive, 1 - active, 2 - deleted
        $user->status        = 1;
        $user->save();

        $role = "Admin";
        if ($request->role == 1) {
            $role = "Staff";
        }

        if ($user) { // When user save on database successfully
            return response()->json([
                'message' => $role.' created successfully',
                'code'    => '200'
            ]);
        }

    }

    public function validateRegisterAdmin($request) {
        $rules = [
            'username'              => 'required|unique:users',
            'email'                 => 'required|email|unique:users',
            'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
            'password'              => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])[a-zA-Z0-9!@#$%^&*()_+]{8,}$/',
            'password_confirmation' => ['required', 'same:password'],
            'first_name'            => 'required|min:2',
            'middle_name'           => 'nullable|min:2',
            'last_name'             => 'required|min:2',
            'prefix'                => 'nullable|min:2',
            'profile_photo'         => 'required|mimes:jpeg,jpg,png',
            'role'                  => 'required|in:0,1'
        ];

        return $validator = Validator::make($request->all(), $rules);
    }

    public function getLogin()
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }


    public function postLogin(Request $request)
    {
        $validator = $this->validateLoginAdmin($request);
        $response = response()->json(['errors' => [
            'email' => ['Invalid email or password']]
            ], 422);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (auth('admins')->attempt($credentials)) {
            $user = auth('admins')->user();

            if ($user->status == 1) {
                return response()->json(['message' => 'Login successfully', 'code' => '200']);
            } else {
                return $response;
            }
        }

        return $response;

    }

    // Login validator
    public function validateLoginAdmin(Request $request)
    {
         return Validator::make($request->all(), [ 
            'email'    => 'required|email',
            'password' => ['required', 'string', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/']
        ]);
    }

    public function getforgotPassword()
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.forgot-password');
        
    }

    public function postforgotPassword(Request $request)
    {
    
        $validator = $this->validateForgotPasswordAdmin($request);
        $response = response()->json(['message' => 'Email address not found', 'code' => '422']);

        if (!$validator->passes()) {
            return $response;
        }

        $user = User::where('email_address', $request->email_address)
                ->where('role', 3)
                ->first();

        if (!$user) {
            return $response;
        }

        $token = $user->username.md5(rand(1, 10) . microtime());
        $token_expired_at = Carbon::now()->addDay(1)->format("Y-m-d");

        $user_token = User::where('email_address', $request->email_address)
                      ->update([
                        'token'            => $token,
                        'token_expired_at' => $token_expired_at
                      ]);

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $operating_system = "";
        $browser = "";

        if (preg_match('/linux/i', $agent)) {
            $operating_system = 'Linux OS';
        } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $agent)) {
            $operating_system = 'Mac OS';
        } elseif (preg_match('/windows|win32|win98|win95|win16/i', $agent)) {
            $operating_system = 'Windows OS';
        } elseif (preg_match('/ubuntu/i', $operating_system)) {
            $operating_system = 'Ubuntu OS';
        }

        if(preg_match('/MSIE/i',$agent) && !preg_match('/Opera/i',$agent)){
            $browser = 'Internet Explorer';
        }elseif(preg_match('/Firefox/i',$agent)){
            $browser = 'Mozilla Firefox';
        }elseif(preg_match('/OPR/i',$agent)){
            $browser = 'Opera';
        }elseif(preg_match('/Chrome/i',$agent) && !preg_match('/Edge/i',$agent)){
            $browser = 'Google Chrome';
        }elseif(preg_match('/Safari/i',$agent) && !preg_match('/Edge/i',$agent)){
            $browser = 'Apple Safari';
        }elseif(preg_match('/Netscape/i',$agent)){
            $browser = 'Netscape';
        }elseif(preg_match('/Edge/i',$agent)){
            $browser = 'Edge';
        }elseif(preg_match('/Trident/i',$agent)){
            $browser = 'Internet Explorer';
        }

        // Sent to email here
        Mail::to($request->email_address)
            ->send(new CustomerForgotPassword(
                $user->username,
                $request->email_address,
                $token,
                $operating_system,
                $browser
            )
        );

        return response()->json(['message' => 'Reset password emailed successfully. Kindly check your inbox.', 'code' => '200']);        

    }

    public function validateForgotPasswordAdmin($request) {
        return Validator::make($request->all(), [ 
            'email' => 'required|email',
        ]);
    }

    public function getResetPassword($token)
    {
        if (auth()->check()) {
            return redirect('customer/dashboard');
        }

        $token = User::where('token', $token)
                ->where('role', 3)
                ->where('token_expired_at', '>', date('Y-m-d'))
                ->first();

        if (!$token) {
            return view('customer.reset-password-expired');
        }

        return view('customer.reset-password');
    }

    public function postResetPassword(Request $request)
    {
        $user = User::where('token', $request->reset_token)
                ->where('token_expired_at', '>', date('Y-m-d'))
                ->where('role', 3)
                ->first();

        if (!$user) {
            return response()->json([
                'error' => ['Token link is expired.'],
                'code'  => '422'
            ]);
        }

        $validator = $this->validateResetPasswordAdmin($request);

        if (!$validator->passes()) {
            return response()->json([
                'error' => $validator->errors()->all(),
                'code'  => '422'
            ]);
        }   

        $user = User::where('id', $user->id)
                    ->where('role', 3)
                    ->update([
                        'password'          => Hash::make($request->new_password, ['rounds' => 12]),
                        'token'             => null,
                        'token_expired_at'  => null
                    ]);
        
        return response()->json([
            'message' => 'Password reset successfully',
            'code'    => '200'
        ]);
        
    }

    public function validateResetPasswordAdmin(Request $request) {
        return Validator::make($request->all(), [
            'new_password'          => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'password_confirmation' => ['required', 'same:new_password']
        ]);
    }

    public function logout()
    {
        if (isset(auth()->user()->id)) {
            // ActivityLogHelper::save(
            //     'User Logout', 
            //     'Logout', 
            //     request()->ip(),
            //     auth()->user()->id
            // );
        }

        Session::flush();
        Auth::logout();
        return redirect('/admin/login');
    }
  
}
