<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployerStatusEmail;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use App\Models\Employer;
use Carbon\Carbon;

class AdminEmployerController extends Controller
{
    public function getEmployers() {
        $employers = Employer::orderBy('created_at', 'desc')
                    ->with('invoice')
                    ->get();

        return view('admin.employers', compact('employers'));
    }

    public function getEmployerById(Request $request) {
        $employer = Employer::where('id', (int)$request->id)->first();
        return response()->json($employer);
    }

    public function updateEmployerApproval(Request $request){
        $employer = Employer::where('id', (int)$request->id);
        $employer->update([
            'status' => $request->status // 0 - pending, 1 - approved, 2 - rejected
        ]);

        $emp = $employer->first();
        Mail::to($emp['email'])
            ->send(new EmployerStatusEmail(
                $employer->first()
            )
        );

        if ($employer) {
            return response()->json([
                'message' => 'Employer status updated successfully',
                'code'    => '200'
            ]);
        }
    }

}
