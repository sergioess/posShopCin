<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;
use App\ShoppingCart;

use Jenssegers\Agent\Agent;

class CredibancoService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $clientId;

    protected $clientSecret;

    // protected $plans;

    public function __construct()
    {
        $this->baseUri = config('services.credibanco.base_uri');
        $this->clientId = config('services.credibanco.client_id');
        $this->clientSecret = config('services.credibanco.client_secret');
        // $this->plans = config('services.credibanco.plans');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        //dd($headers);
        $headers['Authorization'] = $this->resolveAccessToken();
        // $formParams['userName'] = $this->clientId;
        // $formParams['password'] = $this->clientSecret;
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        // $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

        // return "Basic {$credentials}";

        $formParams['userName'] = $this->clientId;
        $formParams['password'] = $this->clientSecret;
    }

    public function handlePayment(Request $request, $OrderID)
    {


        
        $order = $this->createOrder($request->amount, $request, $OrderID);

        //dd($order);

        session()->put('approvalId', $order->orderId);

        //session()->put('dataR', $request);

        return redirect($order->formUrl);
    }

    public function handleApproval()
    {
        //dd(session()->get('approvalId'));
        if (session()->has('approvalId')) {

            $approvalId = session()->get('approvalId');
            //dd($approvalId);
            $payment = $this->capturePayment($approvalId);
            //dd($payment->paymentAmountInfo->paymentState);
            return $payment;

            // $name = $payment->payer->name->given_name;
            // $payment = $payment->purchase_units[0]->payments->captures[0]->amount;
            // $amount = $payment->value;
            // $currency = $payment->currency_code;

            // return redirect()
            //     ->route('home')
            //     ->withSuccess(['payment' => "Thanks,  We received your  payment."]);
        }

        // return redirect()
        //     ->route('home')
        //     ->withErrors('We cannot capture your payment. Try again, please');
    }

    public function handleSubscription(Request $request)
    {
        $subscription = $this->createSubscription(
            $request->plan,
            $request->user()->name,
            $request->user()->email
        );

        $subscriptionLinks = collect($subscription->links);

        $approve = $subscriptionLinks->where('rel', 'approve')->first();

        session()->put('subscriptionId', $subscription->id);

        return redirect($approve->href);
    }

    public function validateSubscription(Request $request)
    {
        if (session()->has('subscriptionId')) {
            $subscriptionId = session()->get('subscriptionId');

            session()->forget('subscriptionId');

            return $request->subscription_id == $subscriptionId;
        }

        return false;
    }

    public function createOrder($value, Request $request, $OrderID)
    {

        $agent = new Agent();
        if ($agent->isMobile())
        {
            $pageView="MOBILE";
        }
        else
        {
            $pageView="DESKTOP";
            //dd("esDesktop");
        }

        return $this->makeRequest(
            'POST',
            'register.do',
            [
                'userName' => $this->clientId,
                'password' => $this->clientSecret,
                'orderNumber' => $OrderID,
                'amount' => $value * 100,
                'returnUrl' => url('approval'),
                'failUrl' => url('cancelled'),
                'pageView' => $pageView,
            ],
            [
                $request
            ],
            [],
            $isJsonRequest = true
        );
    }

    public function capturePayment($approvalId)
    {


        return $this->makeRequest(
            'POST',
            'getOrderStatusExtended.do',
            [
                'userName' => $this->clientId,
                'password' => $this->clientSecret,                
                'orderId' => $approvalId,
                'language' => 'es',
                'Content-Type' => 'application/json',
            ],
            [],
            [],
            $isJsonRequest = true
        );


    }

    // public function createSubscription($planSlug, $name, $email)
    // {
    //     return $this->makeRequest(
    //         'POST',
    //         '/v1/billing/subscriptions',
    //         [],
    //         [
    //             'plan_id' => $this->plans[$planSlug],
    //             'subscriber' => [
    //                 'name' => [
    //                     'given_name' => $name,
    //                 ],
    //                 'email_address' => $email,
    //             ],
    //             'application_context' => [
    //                 'brand_name' => config('app.name'),
    //                 'shipping_preference' => 'NO_SHIPPING',
    //                 'user_action' => 'SUBSCRIBE_NOW',
    //                 'return_url' => route('subscribe.approval', ['plan' => $planSlug]),
    //                 'cancel_url' => route('subscribe.cancelled'),
    //             ]
    //         ],
    //         [],
    //         $isJsonRequest = true,
    //     );
    // }

    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }

        return 100;
    }
}