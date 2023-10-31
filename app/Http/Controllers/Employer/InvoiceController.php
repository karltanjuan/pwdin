<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use Session;
use Storage;
use App\Models\Employer;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function getSubscription() {
        $invoice = Invoice::with('transaction')
                    ->where('employer_id', auth()->guard('employers')->user()->id)
                    ->first();
                
        $is_expire = 1;

        if ($invoice) {
            if ($invoice->count() > 0 && !is_null($invoice->transaction)) {
                if ($invoice->transaction->status === "Paid") {

                    $expired_at = $invoice->pluck('subscription_expired_at')[0];
            
                    $subscription_expired_at = Carbon::parse($expired_at);
                    if (Carbon::now()->isBefore($subscription_expired_at)) {
                        $is_expire = 0;
                    }
                }
            }
        }
        
        return view('employer.subscription', compact('is_expire', 'expired_at', 'invoice'));
    }

    public function createInvoice(Request $request) {
        $employer_id = auth()->guard('employers')->user()->id;
        $employer = Employer::where('id', $employer_id)->first();

        try {
            DB::beginTransaction();

            $reference_no = self::generateReferenceNo();

            $invoice_id = Invoice::where('employer_id', $employer_id)->pluck('id');

            if (count($invoice_id) > 0) {
                $invoice = Invoice::updateOrCreate([
                    'id' => $invoice_id,
                ], [
                    'reference_number'        => $reference_no,
                    'employer_id'             => $employer_id,
                    'product_name'            => 'pwdIn 1 Year Subscription',
                    'description'             => 'pwdIn 1 Year Subscription',
                    'quantity'                => 1,
                    'currency'                => 'PHP',
                    'total_amount'            => 400000, // 4000 pesos
                    'payment_method'          => '',
                    'subscription_expired_at' => Carbon::now()->addYear()->toDateTimeString()
                ]);
    
                $transaction = Transaction::updateOrCreate([
                    'invoice_id' => $invoice->id,
                ], [
                    'invoice_id'          => $invoice->id,
                    'checkout_session_id' => '',
                    'transaction_details' => '',
                    'status'              => 'Pending'
                ]);
            } else {
                $invoice = Invoice::create([
                    'reference_number'        => $reference_no,
                    'employer_id'             => $employer_id,
                    'product_name'            => 'pwdIn 1 Year Subscription',
                    'description'             => 'pwdIn 1 Year Subscription',
                    'quantity'                => 1,
                    'currency'                => 'PHP',
                    'total_amount'            => 400000, // 4000 pesos
                    'payment_method'          => '',
                    'subscription_expired_at' => Carbon::now()->addYear()->toDateTimeString()
                ]);
    
                $transaction = Transaction::create([
                    'invoice_id'          => $invoice->id,
                    'checkout_session_id' => '',
                    'transaction_details' => '',
                    'status'              => 'Pending'
                ]);
            }

            

            // if (is_null($invoice_id)) {
            //     $invoice = Invoice::create([
            //         'reference_number'        => $reference_no,
            //         'employer_id'             => $employer_id,
            //         'product_name'            => 'pwdIn 1 Year Subscription',
            //         'description'             => 'pwdIn 1 Year Subscription',
            //         'quantity'                => 1,
            //         'currency'                => 'PHP',
            //         'total_amount'            => 400000, // 4000 pesos
            //         'payment_method'          => '',
            //         'subscription_expired_at' => Carbon::now()->addYear()->toDateTimeString()
            //     ]);
    
            //     $transaction = Transaction::create([
            //         'invoice_id'          => $invoice->id,
            //         'checkout_session_id' => '',
            //         'transaction_details' => '',
            //         'status'              => 'Pending'
            //     ]);
            // }
            
            DB::commit();

            // Create Paymongo checkout session
            $send_email_receipt    = true;
            $show_description      = true;
            $show_line_items       = true;
            $cancel_url            = env('APP_URL').'/employer/jobs';
            $description           = $invoice->description;
            $currency              = $invoice->currency;
            $amount                = $invoice->total_amount;
            $line_item_description = "pwdIn 1 Year Subscription";
            $quantity              = 1;
            $line_item_name        = $invoice->product_name;
            $payment_methods_types = ["card", "gcash", "paymaya", "dob", "dob_ubp", "grab_pay"];
            $reference_number      = $invoice->reference_number;
            $success_url           = env('APP_URL')."/employer/transaction-message/{$employer_id}";

            $payload = [
                "data" => [
                    "attributes" => [
                        "send_email_receipt"   => $send_email_receipt,
                        "show_description"     => $show_description,
                        "show_line_items"      => $show_line_items,
                        "cancel_url"           => $cancel_url,
                        "description"          => $description,
                        "line_items"           => [
                            [
                                "currency"     => $currency,
                                "amount"       => $amount,
                                "description"  => $description,
                                "quantity"     => $quantity,
                                "name"         => $line_item_name
                            ]
                        ],
                        "payment_method_types" => $payment_methods_types,
                        "reference_number"     => $reference_number,
                        "success_url"          => $success_url
                    ]
                ]
            ];

            $paymongo_api_key = env('PAYMONGO_TEST_API_KEY_ENCODED');
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
                'body' => json_encode($payload),
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'accept'        => 'application/json',
                    'authorization' => 'Basic '.$paymongo_api_key,
                ],
            ]);

            $response_content    = $response->getBody()->getContents();
            $response_data       = json_decode($response_content, true);
            $checkout_session_id = $response_data['data']['id'];

            $update_transaction = Transaction::where('id', $transaction->id)->update([
                'checkout_session_id' => $checkout_session_id,
                'transaction_details' => json_encode($response_data), // For transaction history reference
                'updated_at'          => date('Y-m-d H:i:s')
            ]);

            return response()->json($response_data, 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }
    }

    public static function generateReferenceNo() {
        // Get the latest reference number from the database
        $latest_reference = Invoice::latest('reference_number')->first();

        if ($latest_reference) {
            $numeric_part = (int)substr($latest_reference->reference_number, 6);
            $new_numeric_part = $numeric_part + 1;
        } else {
            $new_numeric_part = 1;
        }

        $new_reference_number = 'PWDIN_' . str_pad($new_numeric_part, 10, '0', STR_PAD_LEFT);

        return $new_reference_number;
    }

}