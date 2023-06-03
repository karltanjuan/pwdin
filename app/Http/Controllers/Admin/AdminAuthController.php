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

    public function getLogin()
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }


    public function postLogin(Request $request)
    {
        $validator = $this->validateLogin($request);
        $response = response()->json(['errors' => [
            'email' => ['Invalid email or password']]
            ], 422);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (auth('admin')->attempt($credentials)) {
            $user = auth('admin')->user();

            if ($user->status == 1) {
                return response()->json(['message' => 'Login successfully', 'code' => '200']);
            } else {
                return $response;
            }
        }

        return $response;

        // $user = Admin::where('email', $request->email)
        //             ->where('status', 1)
        //             ->first();


        // if (!$user) {
        //     return $response;
        // }

        // // compare database password to input password
        // if (!Hash::check($request->password, $user->password)) {
        //     return $response;
        // }

        // Auth::login(new Admin, ['email' => $request->email, 'password' => $request->password]);

        // ActivityLogHelper::save(
        //     'User Login', 
        //     'Login', 
        //     request()->ip(),
        //     auth()->user()->id
        // );

        return response()->json(['message' => 'Login successfully', 'code' => '200']);

    }

    // Login validator
    public function validateLogin(Request $request)
    {
         return Validator::make($request->all(), [ 
            'email'    => 'required|email',
            'password' => ['required', 'string', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/']
        ]);
    }

    public function getforgotPassword()
    {
        if (auth()->check()) {
            return redirect('customer/dashboard');
        }

        return view('customer.forgot-password');
        
    }

    public function postforgotPassword(Request $request)
    {
    
        $validator = $this->validateForgotPassword($request);
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

    public function validateForgotPassword($request) {
        return Validator::make($request->all(), [ 
            'email_address' => 'required|email',
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

        $validator = $this->validateResetPassword($request);

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
        return redirect('/admin/login');
    }
  
}
