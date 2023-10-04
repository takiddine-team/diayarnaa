<?php

namespace App\Http\Controllers\PayPal;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\PremiumMembership;
use App\Models\User;
use App\Models\UserMembership;
use App\Traits\SharedTrait;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as ServicesPayPal;
use Illuminate\Support\Facades\DB;

class PayPalPaymentController extends Controller
{
    public $payment_transaction;
    use SharedTrait;


    public function processTransaction(Request $request, $premium_membership_id)
    {


        if (isset($premium_membership_id)) {

            $user = User::find(auth()->guard('user')->user()->id);
            $premium_membership = PremiumMembership::where('id', $premium_membership_id)->where('status', 1)->where('user_type', $user->getAttributes()['user_type'])->first();

            if (isset($premium_membership)) {

                DB::transaction(function () use ($premium_membership) {
                    $this->payment_transaction =  PaymentTransaction::create([
                        'user_id' => auth()->guard('user')->user()->id,
                        'premium_membership_id' => $premium_membership->id,
                        'amount' => $premium_membership->price,
                    ]);
                });


                $provider = new ServicesPayPal;
                $provider->setApiCredentials(config('paypal'));
                $paypalToken = $provider->getAccessToken();

                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('successTransaction', $this->payment_transaction->id ? $this->payment_transaction->id : 'no'),
                        "cancel_url" => route('cancelTransaction', ['payment_transaction' => $this->payment_transaction->id]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => "USD",
                                "value" => number_format($premium_membership->price, 2)
                            ]
                        ]
                    ]
                ]);
                DB::transaction(function () use ($response) {
                    $this->payment_transaction->update([
                        'payment_id' => $response['id'], // PayPal
                        'payment_status' => 1,
                    ]);
                });
                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()->route('PremiumMembership')->with('danger', @trans('front.SomethingWentWrong'));
                } else {
                    return redirect()->route('PremiumMembership')->with('danger', @trans('front.SomethingWentWrong'));
                }
            } else {
                return redirect()->route('PremiumMembership')->with('danger', @trans('front.PremiumMembershipNotFound'));
            }
        } else {
            return redirect()->route('PremiumMembership')->with('danger', @trans('PremiumMembershipNotFound'));
        }
    }
    public function successTransaction(Request $request, $payment_transaction)
    {
        $payment_transaction = PaymentTransaction::find($payment_transaction);
        if ($payment_transaction) {
            // return $payment_transaction;
            $premium_membership = PremiumMembership::where('id', $payment_transaction->premium_membership_id)->where('status', 1)->first();
            $provider = new ServicesPayPal();
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                DB::transaction(function () use ($payment_transaction, $response, $premium_membership) {
                    $payment_transaction->update([
                        'payment_status' => 2,
                    ]);
                    // التحقق اذا كانت نوع العضويه يتكون من عدد غير محدود من الاعلانات
                    if ($premium_membership->unlimited_status == 'True') {
                        UserMembership::create([
                            'user_id' => $payment_transaction->user_id,
                            'premium_membership_id' => $premium_membership->id,
                            'number_of_ads' => 1000,
                            'expiry_date' => now()->addDays($premium_membership->number_days_membership),
                            'status' => 1,
                        ]);
                    } else {
                        UserMembership::create([
                            'user_id' => $payment_transaction->user_id,
                            'premium_membership_id' => $premium_membership->id,
                            'number_of_ads' => $premium_membership->number_of_ads,
                            'expiry_date' => now()->addDays($premium_membership->number_days_membership),
                            'status' => 1,
                        ]);
                    }
                });
                return redirect()->route('PremiumMembership')->with('success', @trans('PurchaseCompletedSuccessfully'));
            } else {
                return redirect()->route('PremiumMembership')->with('danger', @trans('SomethingWentWrongPleaseTryAgain'));
            }
        } else {
            return redirect()->route('PremiumMembership')->with('danger', @trans('front.PaypalInfoNotCorrect'));
        }
    }
    public function cancelTransaction(Request $request, $payment_transaction)
    {
        $payment_transaction = PaymentTransaction::find($payment_transaction);
        if ($payment_transaction) {
            DB::transaction(function () use ($payment_transaction) {
                $payment_transaction->update([
                    'payment_status' => '3',
                ]);
            });
        } else {
            return redirect()->route('PremiumMembership')->with('danger',@trans('front.PaypalInfoNotCorrect'));
        }

        return redirect()->route('PremiumMembership')->with('danger',@trans('front.PayPalCanceled'));
    }
}
