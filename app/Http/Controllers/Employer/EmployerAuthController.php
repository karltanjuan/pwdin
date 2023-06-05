<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingEmployerEmail;
use Validator;
use Session;
use Storage;
use Auth;
use Hash;
use App\Models\Employer;
use Carbon\Carbon;


class EmployerAuthController extends Controller
{

    public function getRegister()
    {
        if (auth()->check()) {
            return redirect('employer/dashboard');
        }

        return view('employer.register');
    }


    public function postRegister(Request $request)
    {       
        $validator = $this->validateRegisterEmployer($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // company_logo
        $company_logo_file = null;
        $company_logo_path = "";
        if ($request->file('company_logo')) {
            $company_logo_file = $request->file('company_logo');
            $company_logo_path = uniqid().md5(1).'_'.$company_logo_file->getClientOriginalName();
            $company_logo_path = $request->file('company_logo')->storeAs('public/employer/company-logo', $company_logo_path);
        }

        // business_permit upload
        $business_permit_file = null;
        $business_permit_path = "";
        if ($request->file('business_permit')) {
            $business_permit_file = $request->file('business_permit');
            $business_permit_path = uniqid().md5(1).'_'.$business_permit_file->getClientOriginalName();
            $business_permit_path = $request->file('business_permit')->storeAs('public/employer/business_permit', $business_permit_path);
        }

        // bir_certificate upload
        $bir_certificate_file = null;
        $bir_certificate_path = "";
        if ($request->file('bir_certificate')) {
            $bir_certificate_file = $request->file('bir_certificate');
            $bir_certificate_path = uniqid().md5(1).'_'.$bir_certificate_file->getClientOriginalName();
            $bir_certificate_path = $request->file('bir_certificate')->storeAs('public/employer/bir_certificate', $bir_certificate_path);
        }

        // save to database
        $user = new Employer();
        $user->username        = $request->username; // validate must be unique
        $user->email           = $request->email; // validate must be unique
        $user->password        = bcrypt($request->password); // must be minimum 8 alphanumeric character with special symbol with capital and small character, validate with confirm password
        $user->contact_person  = $request->contact_person; // required
        $user->mobile_no       = $request->mobile_no; // starts with 09#########, must be 12 digit
        $user->company_name    = $request->company_name; // required
        $user->address         = $request->address; // required
        $user->province        = $request->province; // required
        $user->city            = $request->city; // required
        $user->summary         = $request->summary; // maximum 300 words
        $user->zip_code        = $request->zip_code; // validated as 4 digit
        $user->company_logo    = $company_logo_path; // validate as jpg, jpeg or png
        $user->business_permit = $business_permit_path; // validate as pdf, jpg, jpeg, or png
        $user->bir_certificate = $bir_certificate_path; // validate as pdf, jpg, jpeg, or png
        $user->status          = 0; // 0 - inactive, 1 - active, 2 - deleted
        $user->save();

        // Send email to employer for pending registration
        Mail::to($request->email)
            ->send(new PendingEmployerEmail(
                $request->username,
                $request->email
            )
        );

        if ($user) { // When user save on database successfully
            return response()->json([
                'message' => 'Employer created successfully',
                'code'    => '200'
            ]);
        }

    }

    public function validateRegisterEmployer($request) {
        $rules = [
            'username'              => 'required|unique:users',
            'email'                 => 'required|email|unique:users',
            'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
            'password'              => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])[a-zA-Z0-9!@#$%^&*()_+]{8,}$/',
            'password_confirmation' => ['required', 'same:password'],
            'contact_person'        => 'required',
            'company_name'          => 'required',
            'province'              => 'required|',
            'city'                  => 'required|',
            'zip_code'              => 'required|digits:4',
            'address'               => 'required',
            'summary'               => 'max:300',
            'company_logo'          => 'required|mimes:jpeg,jpg,png',
            'business_permit'       => 'required|mimes:pdf,jpeg,jpg,png',
            'bir_certificate'       => 'required|mimes:pdf,jpeg,jpg,png'
        ];

        return $validator = Validator::make($request->all(), $rules);
    }

        public function getLogin()
    {
        if (auth()->check()) {
            return redirect('employer/dashboard');
        }

        return view('employer.login');
    }


    public function postLogin(Request $request)
    {
        $validator = $this->validateLoginEmployer($request);
        $response = response()->json(['errors' => [
            'email' => ['Invalid email or password']]
            ], 422);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (auth('employers')->attempt($credentials)) {
            $user = auth('employers')->user();

            if ($user->status == 1) {
                return response()->json(['message' => 'Login successfully', 'code' => '200']);
            } else {
                return $response;
            }
        }

        return $response;

    }

    // Login validator
    public function validateLoginEmployer(Request $request)
    {
         return Validator::make($request->all(), [ 
            'email'    => 'required|email',
            'password' => ['required', 'string', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/']
        ]);
    }

}
