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
use App\Models\Job;
use App\Models\Application;
use App\Models\ApplicationStatus;
use App\Models\Invoice;
use App\Models\Transaction;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function createInvoice(Request $request) {
        $job_id = (int) $request->job_id;

        $job = Job::where('id', $job_id)->first();

        try {
            DB::beginTransaction();

            $reference_no = self::generateReferenceNo();

            $invoice = Invoice::create([
                'reference_number' => $reference_no,
                'job_id'           => $job->id,
                'customer_id'      => $job->employer_id,
                'product_name'     => $job->job_title,
                'description'      => strip_tags($job->job_description),
                'quantity'         => 1,
                'currency'         => 'PHP',
                'total_amount'     => 200000,
                'payment_method'   => 'cash'
            ]);

            $transaction = Transaction::create([
                'invoice_id' => $invoice->id,
                'status'     => 'Pending'
            ]);
            
            DB::commit();

            // Create Paymongo checkout session
            $send_email_receipt    = true;
            $show_description      = true;
            $show_line_items       = true;
            $cancel_url            = "https://google.com";
            $description           = $invoice->description;
            $currency              = $invoice->currency;
            $amount                = $invoice->total_amount;
            $line_item_description = "Job Post";
            $quantity              = 1;
            $line_item_name        = $invoice->product_name;
            $payment_methods_types = ["card", "gcash", "paymaya", "dob", "dob_ubp", "grab_pay"];
            $reference_number      = $invoice->reference_number;
            $success_url           = "http://localhost:8000/employer/jobs";

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

            $response_content = $response->getBody()->getContents();
            $response_data    = json_decode($response_content, true);

            return response()->json($response_data, 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }

        // if ($job) {
        //     return response()->json([
        //         'message' => 'Job created successfully',
        //         'code'    => '200'
        //     ]);
        // }

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
