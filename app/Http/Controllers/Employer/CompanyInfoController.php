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


class CompanyInfoController extends Controller
{
    public function getCompanyInfo() {
        return view('employer.company-info');
    }

    public function updateCompanyInfo(Request $request) {
        $validator = $this->validateCompany($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $company_logo_file = null;
        $company_logo_path = "";
        if ($request->file('company_logo')) {
            $company_logo_file = $request->file('company_logo');
            $company_logo_path = uniqid().md5(1).'_'.$company_logo_file->getClientOriginalName();
            $company_logo_path = $request->file('company_logo')->storeAs('public/employer/company-logo', $company_logo_path);

            $old_file = $request->input('old_file');
            if ($old_file) {
                Storage::delete($old_file);
            }
        }


        $employer_data = [
            'username'       => $request->username,
            'email'          => $request->email,
            'contact_person' => $request->contact_person,
            'mobile_no'      => $request->mobile_no,
            'company_name'   => $request->company_name,
            'address'        => $request->address,
            'province'       => $request->province,
            'city'           => $request->city,
            'zip_code'       => $request->zip_code,
            'summary'        => $request->summary,
        ];

        if (!empty($company_logo_path)) {
            $employer_data['company_logo'] = $company_logo_path;
        }
   
        $user = Employer::where('id', auth()->guard('employers')->user()->id)
                ->update($employer_data);
        
        return response()->json([
            'message' => 'Company information updated successfully',
            'code'    => '200'
        ]);
    }

    public function validateCompany(Request $request) {
        $id = auth()->guard('employers')->user()->id;

        return Validator::make($request->all(), [
            // 'company_logo'          => 'required|mimes:jpeg,jpg,png',
            'username'              => 'required|unique:users,username,'.$id,
            'email'                 => 'required|email|unique:users,email,'.$id,
            'mobile_no'             => 'required|regex:/^09[0-9]{9}$/',
            'contact_person'        => 'required',
            'company_name'          => 'required',
            'province'              => 'required',
            'city'                  => 'required',
            'zip_code'              => 'required|digits:4',
            'address'               => 'required',
            'summary'               => 'required|max:300',
        ]);
    }
}
