<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\CardService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $input = $request->all();
        $dataSession = [
            'discount_summary' => $input['discount_summary'] ?? null,
            'new_address' => $input['new_address'] ?? null,
            'payment_method' => $input['payment_method'],
            'note' => $input['note'],
            'summary' => $input['summary'],
            'delivery_address' => $input['delivery_address'],
        ];
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "10"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    session()->put('paypalPayment', $dataSession);
                    return redirect()->away($links['href']);
                }
            }

            Alert::error('Xảy ra lỗi với tính năng thanh toán qua Paypal');
            return redirect()
                ->back();
        } else {
            Alert::error('Xảy ra lỗi với tính năng thanh toán qua Paypal');
            return redirect()
                ->back();
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $dataSession = session()->get('paypalPayment');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $result = $this->cardService->payment($dataSession);

            if (!$result) {
                Alert::error('Xảy ra lỗi trong quá trình đặt hàng!');
                return redirect()->back();
            }

            session()->forget('paypalPayment');
            Alert::success('Thanh toán thành công');
            return redirect()
                ->route('thank-you');
        } else {
            Alert::error('Xảy ra lỗi trong quá trình thanh toán');
            return redirect()
                ->back();
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        Alert::error('Bạn đã hoãn quá trình thanh toán vì lí do không xác định');
        return redirect()
            ->back();
    }
}
