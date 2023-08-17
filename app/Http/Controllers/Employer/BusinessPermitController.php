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


class BusinessPermitController extends Controller
{
    public function getBusinessPermit() {
        return view('employer.business-permit');
    }

    public function updateBusinessPermit(Request $request) {

        $validator = $this->validateBusinessPermit($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $business_permit_file = null;
        $business_permit_path = "";
        if ($request->file('business_permit')) {
            $business_permit_file = $request->file('business_permit');
            $business_permit_path = uniqid().md5(1).'_'.$business_permit_file->getClientOriginalName();
            $business_permit_path = $request->file('business_permit')->storeAs('public/employer/business_permit', $business_permit_path);

            $old_file = $request->input('old_file');
            if ($old_file) {
                Storage::delete($old_file);
            }
        }
   
        $user = Employer::where('id', auth()->guard('employers')->user()->id)
                ->update([
                    'business_permit' => $business_permit_path
                ]);
        
        return response()->json([
            'message' => 'Business Permit updated successfully',
            'code'    => '200'
        ]);
    }

    public function validateBusinessPermit(Request $request) {
        return Validator::make($request->all(), [
            'business_permit' => 'required|mimes:pdf,jpeg,jpg,png'
        ]);
    }
}
