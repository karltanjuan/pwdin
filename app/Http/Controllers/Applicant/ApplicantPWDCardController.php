<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use Hash;
use App\Models\User;
use Carbon\Carbon;


class ApplicantPWDCardController extends Controller
{
    public function getChangePWDCard() {
        return view('applicant.pwd-card');
    }

    public function updatePWDCard(Request $request) {

        $validator = $this->validatePWDCard($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $card_file = null;
        $card_path = "";
        if ($request->file('pwd_card')) {
            $card_file = $request->file('pwd_card');
            $card_path = uniqid().md5(1).'_'.$card_file->getClientOriginalName();
            $card_path = $request->file('pwd_card')->storeAs('public/applicant/pwd_card', $card_path);

            $old_file = $request->input('old_file');
            if ($old_file) {
                Storage::delete($old_file);
            }
        }
   
        $user = User::where('id', auth()->user()->id)
                ->update([
                    'pwd_card' => $card_path
                ]);
        
        return response()->json([
            'message' => 'PWD Card updated successfully',
            'code'    => '200'
        ]);
    }

    public function validatePWDCard(Request $request) {
        return Validator::make($request->all(), [
            'pwd_card' => 'required|mimes:jpeg,jpg,png'
        ]);
    }
}
