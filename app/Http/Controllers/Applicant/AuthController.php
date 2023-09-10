<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingApplicantEmail;
use App\Mail\ApplicantForgotPasswordEmail;
use Validator;
use Session;
use Storage;
use Auth;
use Hash;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function getRegister()
    {
        if (auth()->check()) {
            return redirect('applicant/dashboard');
        }

        return view('applicant.register');
    }

    public function postRegister(Request $request)
    {       
        $validator = $this->validateRegisterApplicant($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // 422 - Unprocessable Entity
        }

        // resume upload
        $resume_file = null;
        $resume_path = "";
        if ($request->file('resume')) {
            $resume_file = $request->file('resume');
            $resume_path = uniqid().md5(1).'_'.$resume_file->getClientOriginalName();
            $resume_path = $request->file('resume')->storeAs('public/applicant/resume', $resume_path);
        }

        // pwd_card upload
        $card_file = null;
        $card_path = "";
        if ($request->file('pwd_card')) {
            $card_file = $request->file('pwd_card');
            $card_path = uniqid().md5(1).'_'.$card_file->getClientOriginalName();
            $card_path = $request->file('pwd_card')->storeAs('public/applicant/pwd_card', $card_path);
        }

        // profile_photo upload
        $profile_file = null;
        $profile_path = "";
        if ($request->file('profile_photo')) {
            $profile_file = $request->file('profile_photo');
            $profile_path = uniqid().md5(1).'_'.$profie_file->getClientOriginalName();
            $profile_path = $request->file('profile_photo')->storeAs('public/applicant/profile_photo', $profile_path);
        }

        // save to database
        $user = new User();
        $user->username        = $request->username; // validate must be unique
        $user->email           = $request->email; // validate must be unique
        $user->password        = bcrypt($request->password); // must be minimum 8 alphanumeric character with special symbol with capital and small character, validate with confirm password
        $user->first_name      = $request->first_name; // minimum of 2 character
        $user->middle_name     = $request->middle_name; // optional
        $user->last_name       = $request->last_name; // minimum of 2 character
        $user->prefix          = $request->prefix; // optional
        $user->birthdate       = $request->birthdate; // required
        $user->gender          = $request->gender; // required
        $user->mobile_no       = $request->mobile_no; // starts with 09#########, must be 12 digit
        $user->education_level = $request->education_level; // required
        $user->address         = $request->address; // required
        $user->province        = $request->province; // required
        $user->city            = $request->city; // required
        $user->summary         = $request->summary; // maximum 300 words
        $user->zip_code        = $request->zip_code; // validated as 4 digit
        $user->pwd_categories  = $request->pwd_categories;
        $user->profile_photo   = $profile_path; // validate as jpg, jpeg, or png
        $user->resume          = $resume_path; // validate as pdf only
        $user->pwd_card        = $card_path; // validate as jpg, jpeg, or png
        $user->status          = 0; // 0 - inactive, 1 - active, 2 - deleted
        $user->save();

        // Send email to applicant for pending registration
        Mail::to($request->email)
            ->send(new PendingApplicantEmail(
                $request->username,
                $request->email
            )
        );

        if ($user) { // When user save on database successfully
            return response()->json([
                'message' => 'Applicant created successfully',
                'code'    => '200'
            ]);
        }

    }

    public function validateRegisterApplicant($request) {
        // Laravel provides validation rules for each form inputs
        $rules = [
            'username'              => 'required|unique:users',
            'email'                 => 'required|email|unique:users',
            'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
            'password'              => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])[a-zA-Z0-9!@#$%^&*()_+]{8,}$/',
            'password_confirmation' => ['required', 'same:password'],
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
            // 'summary'               => 'max:300',
            'zip_code'              => 'required|digits:4',
            'profile_photo'         => 'required|mimes:jpeg,jpg,png',
            'resume'                => 'required|mimes:pdf',
            'pwd_card'              => 'required|mimes:jpeg,jpg,png',
            // 'status'          => 'required|in:0,1,2',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }

    public function getLogin()
    {
        if (auth()->check()) {
            return redirect('applicant/dashboard');
        }

        return view('applicant.login');
    }


    public function postLogin(Request $request)
    {
        $validator = $this->validateLoginApplicant($request);
        $response = response()->json(['errors' => [
            'email' => ['Invalid email or password']]
            ], 422);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)
                    ->where('status', 1)
                    ->first();

        if (!$user) {
            return $response;
        }

        // compare database password to input password
        if (!Hash::check($request->password, $user->password)) {
            return $response;
        }

        Auth::login($user);

        // ActivityLogHelper::save(
        //     'User Login', 
        //     'Login', 
        //     request()->ip(),
        //     auth()->user()->id
        // );

        return response()->json(['message' => 'Login successfully', 'code' => '200']);

    }

    // Login validator
    public function validateLoginApplicant(Request $request)
    {
         return Validator::make($request->all(), [ 
            'email'    => 'required|email',
            'password' => ['required', 'string', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/']
        ]);
    }

    public function getForgotPassword()
    {
        if (auth()->check()) {
            return redirect('applicant/dashboard');
        }

        return view('applicant.forgot-password');
        
    }

    public function postForgotPassword(Request $request)
    {
        $validator = $this->validateForgotPassword($request);
        $response = response()->json(['message' => 'Email address not found', 'code' => '422']);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $response;
        }

        $token = $user->username.md5(rand(1, 10) . microtime());
        $token_expired_at = Carbon::now()->addDay(1)->format("Y-m-d");

        $user_token = User::where('email', $request->email)
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
        Mail::to($request->email)
            ->send(new ApplicantForgotPasswordEmail(
                $user->username,
                $request->email,
                $token,
                $operating_system,
                $browser
            )
        );

        return response()->json(['message' => 'Reset password emailed successfully. Kindly check your inbox.', 'code' => '200']);        
    }

    public function validateForgotPassword($request) {
        return Validator::make($request->all(), [ 
            'email' => 'required|email',
        ]);
    }

    public function getResetPassword($token)
    {
        if (auth()->check()) {
            return redirect('applicant/dashboard');
        }

        $token = User::where('token', $token)
                ->where('token_expired_at', '>', date('Y-m-d'))
                ->first();

        if (!$token) {
            return view('applicant.reset-password-expired');
        }

        return view('applicant.reset-password');
    }

    public function postResetPassword(Request $request)
    {
        $user = User::where('token', $request->reset_token)
                ->where('token_expired_at', '>', date('Y-m-d'))
                ->first();

        if (!$user) {
            return response()->json([
                'error' => ['Token link is expired.'],
                'code'  => '422'
            ]);
        }

        $validator = $this->validateResetPassword($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        } 

        $user = User::where('id', $user->id)
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

    public function validateResetPassword(Request $request) {
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
        return redirect('/applicant/login');
    }
  
}
