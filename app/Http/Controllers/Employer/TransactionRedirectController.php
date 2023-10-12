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
use App\Models\Job;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRedirectController extends Controller
{
    public function transactionMessage($job_id) {
        $transaction = Transaction::with(['invoice' => function ($query) use ($job_id) {
            $query->where('job_id', $job_id);
        }])->first();

        // Retrieve Paymongo checkout session
        $paymongo_api_key = env('PAYMONGO_TEST_API_KEY_ENCODED');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.paymongo.com/v1/checkout_sessions/'.$transaction->checkout_session_id, [
            'headers' => [
                'Content-Type'  => 'application/json',
                'accept'        => 'application/json',
                'authorization' => 'Basic '.$paymongo_api_key,
            ],
        ]);

        $response_content    = $response->getBody()->getContents();
        $response_data       = json_decode($response_content, true);

        if (isset($response_data['data']['attributes']['payments'])) {
            $data    = $response_data['data']['attributes']['payments'][0]['attributes'];
            $payment_method_used = $response_data['data']['attributes']['payments'][0]['payment_method_used'];
            $status  = ucfirst(strtolower($data['status']));
            $paid_at = date('Y/m/d H:i:s', $data['paid_at']);
        } else {
            $status  = 'Pending';
            $paid_at = null;
            $payment_method_used = '';
        }

        $response = (object) [
            'status'  => $status,
            'paid_at' => Carbon::parse($paid_at)->format('F d, Y h:i A'),
        ];

        try {
            $updated_at = date('Y-m-d H:i:s');

            $invoice = Invoice::where('job_id', $job_id)->update([
                'payment_method' => $payment_method_used,
                'updated_at'     => $updated_at
            ]);

            $update_transaction = Transaction::where('id', $transaction->id)->update([
                'status'              => $status,
                'transaction_details' => json_encode($response_data), // For transaction history reference
                'updated_at'          => $updated_at
            ]);

            $job_status = $status == "Paid" ? 1 : 0;
    
            $job = Job::find($job_id);
            $job->update([
                'status'     => $job_status,
                'updated_at' => $updated_at
            ]);
    
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaction update failed: ' . $e->getMessage()], 500);
        }

        return view('employer.payment-message', compact('response'));
    }
}