<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\DeliveryAddress;
use App\Models\Product;
use App\Models\User;
use App\Services\CardService;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class CardController extends Controller
{
    protected $productService;
    protected $cardService;
    private $gateway;

    public function __construct(ProductService $productService, CardService $cardService)
    {
        $this->productService = $productService;
        $this->cardService = $cardService;
    }

    public function Index()
    {
        return view('paypal.index');
    }

    public function paymentWithOnepay(Request $request)
    {
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";
        $input = $request->all();

        // add the start of the vpcURL querystring parameters
        // *****************************Lấy giá trị url cổng thanh toán*****************************
        $vpcURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op'. "?";
        $address = isset($input['new_address']) ? "&new_address=" . $input['new_address'] . "" : '';
        $code = isset($input['code']) ? "&code=" . $input['code'] . "" : '';

        // Remove the Virtual Payment Client URL from the parameter hash as we
        // do not want to send these fields to the Virtual Payment Client.
        // bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
        // unset($_POST["virtualPaymentClientURL"]);
        // unset($_POST["SubButL"]);
        $vpc_Merchant = 'ONEPAY';
        $vpc_AccessCode = 'D67342C2';
        $vpc_MerchTxnRef = time();
        $vpc_OrderInfo = 'JSECURETEST01';
        $vpc_Amount = '1000000';

        $vnc_Returnurl = "http://allo-store.vn/products/handle-onepay";
        $vpc_Version = '2';
        $vpc_Command = 'pay';
        $vpc_Locale = 'vn';
        $vpc_Currency = 'VND';

        $data = array(
            'vpc_Merchant' => $vpc_Merchant,
            'vpc_AccessCode' => $vpc_AccessCode,
            'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
            'vpc_OrderInfo' => $vpc_OrderInfo,
            'vpc_Amount' => $vpc_Amount,
            'vpc_ReturnURL' => $vnc_Returnurl,
            'vpc_Version' => $vpc_Version,
            'vpc_Command' => $vpc_Command,
            'vpc_Locale' => $vpc_Locale,
            'vpc_Currency' => $vpc_Currency,
        );

        //$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
        $stringHashData = "";
        // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
        // arrange array data a-z before make a hash
        ksort($data);

        // set a parameter to show the first pair in the URL
        // đặt tham số đếm = 0
        $appendAmp = 0;

        foreach ($data as $key => $value) {
            // create the md5 input and URL leaving out any fields that have no value
            // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }
        //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
        $stringHashData = rtrim($stringHashData, "&");
        // Create the secure hash and append it to the Virtual Payment Client Data if
        // the merchant secret has been provided.
        // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
        if (strlen($SECURE_SECRET) > 0) {
            //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
            // *****************************Thay hàm mã hóa dữ liệu*****************************
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)));
        }

        // FINISH TRANSACTION - Redirect the customers using the Digital Order
        // ===================================================================
        // chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
    //    header("Location: ".$vpcURL);
       return redirect()->to($vpcURL);
    }

    public function PaymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            Alert::success('Thanh toán thành công');

            return redirect()->back();
        } else {
            Alert::error('Thất bại');

            return redirect()->route('login');
        }
    }

    public function PaymentCancel()
    {
        Alert::error('Cancel');

        return redirect()->route('login');
    }

    public function addCart(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'quantity' => 'required|numeric|integer|gt:0',
        ]);
        $product = Product::where('id', $params['productId'])->first();

        if ($validator->fails()) {
            Alert::error('Lỗi', 'Số lượng không hợp lệ');

            return redirect()->back();
        }

        if ($product->quantity === 0) {
            Alert::error('Sản phẩm này đã bán hết');

            return redirect()->back();
        }

        if ($params['quantity'] > $product->quantity) {
            Alert::error('Vượt quá số lượng sản phẩm trong kho');

            return redirect()->back();
        }

        $result = $this->cardService->create($params);

        if (!$result) {
            $url = $params['url'];
            Alert::error('Đăng nhập', 'Đăng nhập để thêm vào giỏ hàng');
            return redirect('/login?url=' . $url . '');
        }

        Alert::success('Thành công', 'Thêm sản phẩm vào giỏ hàng thành công');
        return redirect()->route('carts');
    }

    public function showCard()
    {
        $products = $this->cardService->getProduct();
        $sessionProducts = $this->cardService->getProduct();

        return view('product.card-product', [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'carts' => session()->get('carts'),
            'sessionProducts' => $sessionProducts,
        ]);
    }

    public function delete(Request $request, int $productId)
    {
        $carts = session()->get('carts');

        unset($carts[$productId]);

        session()->put('carts', $carts);

        Alert::success('Thành công', 'Xóa sản phẩm thành công');
        return redirect()->back();
    }

    public function update(Request $request, int $productId)
    {
        $input = $request->all();
        $carts = session()->get('carts');
        $product = Product::where('id', $productId)->first();
        $quantity = $input['quantity'];

        $validator = Validator::make($input, [
            'quantity' => 'required|numeric|integer|gt:0',
        ]);

        if ($validator->fails()) {
            Alert::error('Lỗi', 'Số lượng không hợp lệ');
            return redirect()->back();
        }

        if ($quantity > $product->quantity) {
            $quantity = $product->quantity;
        }

        $carts[$productId] = $quantity;
        session()->put('carts', $carts);

        return redirect()->back();
    }

    public function adjust(Request $request, int $productId)
    {
        $input = $request->all();
        $carts = session()->get('carts');
        $product = Product::where('id', $productId)->first();
        if ($input['type'] == 'inc') {
            if ($carts[$productId] == $product->quantity) {
                return redirect()->back();
            }

            $carts[$productId] += 1;
            session()->put('carts', $carts);

            return redirect()->back();
        } else {
            if ($carts[$productId] == 1) {
                return redirect()->back();
            }
            $carts[$productId] -= 1;
            session()->put('carts', $carts);

            return redirect()->back();
        }
    }

    //return to view product.thank-you
    public function thankYou()
    {
        $auth = session()->get('user');
        $user = User::where('id', $auth->id)->first();
        $sessionProducts = $this->cardService->getProduct();

        return view('product.thank-you', [
            'title' => 'Đặt hàng thành công',
            'user' => $user,
            'carts' => session()->get('carts'),
            'sessionProducts' => $sessionProducts,
        ]);
    }

    public function checkout()
    {
        $auth = session()->get('user');
        $user = User::where('id', $auth->id)->first();
        $addresses = DeliveryAddress::where('user_id', $user->id)->get();
        if (!$user) {
            Alert::error('Đăng nhập', 'Đăng nhập để thanh toán');
            return view('auth.login-register', [
                'title' => 'Đăng nhập',
            ]);
        }
        $products = $this->cardService->getProduct();
        $sessionProducts = $this->cardService->getProduct();

        return view('product.checkout', [
            'title' => 'Thanh toán sản phẩm',
            'products' => $products,
            'user' => $user,
            'carts' => session()->get('carts'),
            'sessionProducts' => $sessionProducts,
            'addresses' => $addresses
        ]);
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $result = $this->cardService->payment($input);
        if (!$result) {
            Alert::error('Xảy ra lỗi trong quá trình đặt hàng!');
            return redirect()->back();
        }

        Alert::success('Đặt hàng thành công');
        return redirect()->route('thank-you');
    }

    public function paymentWithMomo(Request $request)
    {
        $input = $request->all();
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $code = isset($input['code']) ? "&code=" . $input['code'] . "" : '';
        $address = isset($input['new_address']) ? "&new_address=" . $input['new_address'] . "" : '';
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        // $amount =  $input['summary'];
        $amount = '1000000';

        $orderId = time() . "";
        $redirectUrl = "http://allo-store.vn/products/handle-momo?summary=" . $input['summary'] . "&payment_method=" . $input['payment_method'] . "&note=" . $input['note'] . "&delivery_address=" . $input['delivery_address'] . "" . $address . "" . $code . "";
        $ipnUrl = "http://allo-store.vn/products/handle-momo?summary=" . $input['summary'] . "&payment_method=" . $input['payment_method'] . "&note=" . $input['note'] . "&delivery_address=" . $input['delivery_address'] . "" . $address . "" . $code . "";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just an example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
    }


    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


    public function paymentWithVNpay(Request $request)
    {
        $input = $request->all();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $address = isset($input['new_address']) ? "&new_address=" . $input['new_address'] . "" : '';
        $code = isset($input['code']) ? "&code=" . $input['code'] . "" : '';
        $vnp_Returnurl = "/products/handle-vnpay?summary=" . $input['summary'] . "&payment_method=" . $input['payment_method'] . "&note=" . $input['note'] . "&delivery_address=" . $input['delivery_address'] . "" . $address . "" . $code . "";
        $vnp_TmnCode = "H1YT811F"; //Mã website tại VNPAY
        $vnp_HashSecret = "WDQPUSPDNNJBDSNVELPJGNSXDUFXUHYF"; //Chuỗi bí mật

        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $input['summary'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $request->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('APP_URL') . $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($input['redirect'])) {
            $input = $request->all();
            $result = $this->cardService->payment($input);
            if (!$result) {
                Alert::error('Xảy ra lỗi trong quá trình đặt hàng!');
                return redirect()->back();
            }

            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

        return $returnData;
    }

    public function handleAfterVNpayReturn(Request $request)
    {
        $vnp_HashSecret = "WDQPUSPDNNJBDSNVELPJGNSXDUFXUHYF";
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                echo "GD Thanh cong";
            } else {
                echo "GD Khong thanh cong";
            }
        } else {
            echo "Chu ky khong hop le";
        }
    }
}
