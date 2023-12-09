<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home');
    }

    public function chooseAccount() {
        if (auth()->guard('employers')->check()) {
            return redirect('employer/dashboard');
        }

        if (auth()->check()) {
            return redirect('applicant/jobs');
        }

        return view('choose-account');
    }

    public function aboutUs(){
        return view('about-us');
    }

    public function contactUs(){
        return view('contact-us');
    }

    public function sendInquiry(Request $request) {
        $validator = $this->validateSendInquiry($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $inquiry = new Inquiry();
        $inquiry->full_name     = $request->full_name;
        $inquiry->email_address = $request->email_address;
        $inquiry->subject       = $request->subject;
        $inquiry->message       = $request->message;
        $inquiry->save();

        if ($inquiry) {
            return response()->json([
                'code' => '200'
            ]);
        }
    }

    public function validateSendInquiry($request) {
        return Validator::make($request->all(), [ 
            'full_name'     => ['required', 'string', 'min         : 2'],
            'email_address' => ['required', 'string', 'email', 'max: 100'],
            'subject'       => ['required', 'string'],
            'message'       => ['required', 'string']
        ]);
    }



}