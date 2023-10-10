<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Storage;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRedirectController extends Controller
{
    public function transactionMessage($checkout_session_id) {
        // Retrieve Paymongo checkout session
        $paymongo_api_key = env('PAYMONGO_TEST_API_KEY_ENCODED');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.paymongo.com/v1/checkout_sessions/'.$checkout_session_id, [
            'headers' => [
                'Content-Type'  => 'application/json',
                'accept'        => 'application/json',
                'authorization' => 'Basic '.$paymongo_api_key,
            ],
        ]);

        $response_content = $response->getBody()->getContents();
        $response_data    = json_decode($response_content, true);

        if (isset($response_data['data']['attributes']['payments'])) {
            $data    = $response_data['data']['attributes']['payments'][0]['attributes'];
            $status  = ucfirst(strtolower($data['status']));
            $paid_at = date('Y/m/d H: i: s A', $data['paid_at']);
        } else {
            $status  = 'Pending';
            $paid_at = null;
        }

        $response = (object) [
            'status'  => $status,
            'paid_at' => $paid_at
        ];

        // Update the transaction table > status [Pending, Paid, Failed] and save the transaction details (add new column on migration)
        // Update the job table > status [0 - pending payment, 1 - active]

        // $job = Job::where('id', $job->id)->update([
        //     'status'     => 1,
        //     'updated_at' => date('Y-m-d H: i: s')
        // ]);

        return view('employer.payment-message', compact('response'));
    }
}
