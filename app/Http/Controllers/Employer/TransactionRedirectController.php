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
    public function transactionMessage($employer_id) {
        if ($employer_id != auth()->guard('employers')->user()->id) {
            $employer_id = 0;
        }

        $invoice = Invoice::where('employer_id', (int)$employer_id)
        ->with('transaction')
        ->first();

        // Retrieve Paymongo checkout session
        $paymongo_api_key = env('PAYMONGO_TEST_API_KEY_ENCODED');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.paymongo.com/v1/checkout_sessions/'.$invoice->transaction->checkout_session_id, [
            'headers' => [
                'Content-Type'  => 'application/json',
                'accept'        => 'application/json',
                'authorization' => 'Basic '.$paymongo_api_key,
            ],
        ]);

        $response_content    = $response->getBody()->getContents();
        $response_data       = json_decode($response_content, true);

        if (!empty($response_data['data']['attributes']['payments'][0]['attributes']['status'])) {
            $data    = $response_data['data']['attributes']['payments'][0]['attributes'];
            $payment_method_used = $response_data['data']['attributes']['payment_method_used'];
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

            $update_invoice = Invoice::where('employer_id', $employer_id)->update([
                'payment_method' => $payment_method_used,
                'updated_at'     => $updated_at
            ]);

            $update_transaction = Transaction::where('id', $invoice->transaction->id)->update([
                'status'              => $status,
                'transaction_details' => json_encode($response_data), // For transaction history reference
                'updated_at'          => $updated_at
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaction update failed: ' . $e->getMessage()], 500);
        }

        return view('employer.payment-message', compact('response'));
    }
}