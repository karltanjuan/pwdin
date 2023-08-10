<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use Storage;
use App\Models\ApplicationStatus;
use Carbon\Carbon;


class ApplicationStatusController extends Controller
{
    public function index() {
        $app_status = ApplicationStatus::orderBy('id', 'asc')->get();
        return view('employer.application-status', compact('app_status'));
    }

    public function saveAppStatus(Request $request){
        $validator = $this->validateAppStatus($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // save to database
        $app_status       = new ApplicationStatus();
        $app_status->name = $request->name; 
        $app_status->save();

        if ($app_status) {
            return response()->json([
                'message' => 'Status created successfully',
                'code'    => '200'
            ]);
        }

    }

    public function getAppStatusById(Request $request) {
        $app_status = ApplicationStatus::where('id', $request->id)->first();
        return response()->json($app_status);
    }

    public function updateAppStatus(Request $request){

        $validator = $this->validateAppStatus($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // save to database
        $app_status = ApplicationStatus::where('id', $request->id);
        $app_status->update([
            'name' => $request->name, 
        ]);

        if ($app_status) {
            return response()->json([
                'message' => 'Status updated successfully',
                'code'    => '200'
            ]);
        }

    }

    public function deleteAppStatus(Request $request){
        $id = (int) $request->id;
        $app_status = ApplicationStatus::where('id', $id)->delete();

        if ($app_status) {
            return response()->json([
                'message' => 'Status deleted successfully',
                'code'    => '200'
            ]);
        }
    }

    public function validateAppStatus($request) {
         $rules = [
            'name' => 'required|string',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }
}
