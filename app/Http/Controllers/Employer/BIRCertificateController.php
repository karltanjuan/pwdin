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


class BIRCertificateController extends Controller
{
    public function getBIRCertificate() {
        return view('employer.bir-certificate');
    }

    public function updateBIRCertificate(Request $request) {

        $validator = $this->validateBIRCertificate($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $bir_certificate_file = null;
        $bir_certificate_path = "";
        if ($request->file('bir_certificate')) {
            $bir_certificate_file = $request->file('bir_certificate');
            $bir_certificate_path = uniqid().md5(1).'_'.$bir_certificate_file->getClientOriginalName();
            $bir_certificate_path = $request->file('bir_certificate')->storeAs('public/employer/bir_certificate', $bir_certificate_path);

            $old_file = $request->input('old_file');
            if ($old_file) {
                Storage::delete($old_file);
            }
        }
   
        $user = Employer::where('id', auth()->guard('employers')->user()->id)
                ->update([
                    'bir_certificate' => $bir_certificate_path
                ]);
        
        return response()->json([
            'message' => 'BIR Certificate updated successfully',
            'code'    => '200'
        ]);
    }

    public function validateBIRCertificate(Request $request) {
        return Validator::make($request->all(), [
            'bir_certificate' => 'required|mimes:pdf,jpeg,jpg,png'
        ]);
    }
}
