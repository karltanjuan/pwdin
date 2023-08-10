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
        $employer_id  = auth()->guard('employers')->user()->id;
        $app_status = ApplicationStatus::where('employer_id', $employer_id)->get();
        return view('employer.application-status', compact('app_status'));
    }

    public function saveAppStatus(Request $request){
        $validator = $this->validateAppStatus($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // save or update to database
        $employer_id  = auth()->guard('employers')->user()->id;
        $status = $request->name;
        $old_status = $request->old_name;


        $employer = ApplicationStatus::firstOrNew(['employer_id' => $employer_id]);
        
        $statuses = [];
        if ($employer->name !== null) {
            $statuses = json_decode($employer->name, true);
        }

        $is_exist = in_array($status, $statuses);

        if (!$is_exist) {
            if ($old_status && in_array($old_status, $statuses)) {
                $statuses[array_search($old_status, $statuses)] = $status;
            } else {
                $statuses[] = $status;
            }
            $new_status = $statuses;
        } else {
            $new_status = $statuses;
        }
        
        $employer->name = json_encode($new_status);
        $employer->save();

        return response()->json([
            'message' => 'Status created successfully',
            'code'    => '200'
        ]);
    }

    public function getAppStatusByName(Request $request) {
        $app_status = ApplicationStatus::whereJsonContains('name', $request->name)->first();

        $response = [];
        foreach (json_decode($app_status->name) as $status) {
            if ($status == $request->name) {
                $response = ['status' => $status];
            }
        }

        return response()->json($response);
    }

    public function deleteAppStatus(Request $request){
        $statusToDelete = $request->name;

        $employer_id = auth()->guard('employers')->user()->id;
        $employer = ApplicationStatus::firstOrNew(['employer_id' => $employer_id]);

        $statuses = [];
        if ($employer->name !== null) {
            $statuses = json_decode($employer->name, true);
        }

        $indexToDelete = array_search($statusToDelete, $statuses);

        unset($statuses[$indexToDelete]);
        $newStatuses = array_values($statuses);

        $employer->name = json_encode($newStatuses);
        $employer->save();

        return response()->json([
            'message' => 'Status deleted successfully',
            'code'    => '200'
        ]);
    }

    public function validateAppStatus($request) {
         $rules = [
            'name' => 'required|string',
        ];

        return $validator = Validator::make($request->all(), $rules);
    }
}
