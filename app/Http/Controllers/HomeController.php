<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function contact(){
        return view('contact-us');
    }

}