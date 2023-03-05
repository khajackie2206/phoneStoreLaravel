<?php

/* -----------------------------------------------------------------------------

 Version 2.0

--------------------------------------------------------------------------------

 @author OnePAy JSC

------------------------------------------------------------------------------*/

// *********************
// START OF MAIN PROGRAM
// *********************


// Define Constants
// ----------------
// This is secret for encoding the MD5 hash
// This secret will vary from merchant to merchant
// To not create a secure hash, let SECURE_SECRET be an empty string - ""
// $SECURE_SECRET = "secure-hash-secret";
$SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";//93E963BC17BF022F2A03B685784D0CFA
//$SECURE_SECRET = "93E963BC17BF022F2A03B685784D0CFA";
// If there has been a merchant secret set then sort and loop through all the
// data in the Virtual Payment Client response. While we have the data, we can
// append all the fields that contain values (except the secure hash) so that
// we can create a hash and validate it against the secure hash in the Virtual
// Payment Client response.


// NOTE: If the vpc_TxnResponseCode in not a single character then
// there was a Virtual Payment Client error and we cannot accurately validate
// the incoming data from the secure hash. */

// get and remove the vpc_TxnResponseCode code from the response fields as we
// do not want to include this field in the hash calculation
$vpc_Txn_Secure_Hash = $_REQUEST ["vpc_SecureHash"];
unset ( $_REQUEST ["vpc_SecureHash"] );

// set a flag to indicate if hash has been validated
$errorExists = false;

if (strlen ( $SECURE_SECRET ) > 0 && $_REQUEST ["vpc_TxnResponseCode"] != "7" && $_REQUEST ["vpc_TxnResponseCode"] != "No Value Returned") {
	ksort($_REQUEST);
    //$stringHashData = $SECURE_SECRET;
    //*****************************khởi tạo chuỗi mã hóa rỗng*****************************
    $stringHashData = "";
	
	// sort all the incoming vpc response fields and leave out any with no value
	foreach ( $_REQUEST as $key => $value ) {
//        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
//            $stringHashData .= $value;
//        }
//      *****************************chỉ lấy các tham số bắt đầu bằng "vpc_" hoặc "user_" và khác trống và không phải chuỗi hash code trả về*****************************
        if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
		    $stringHashData .= $key . "=" . $value . "&";
		}
	}
//  *****************************Xóa dấu & thừa cuối chuỗi dữ liệu*****************************
    $stringHashData = rtrim($stringHashData, "&");	
	
	
//    if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper ( md5 ( $stringHashData ) )) {
//    *****************************Thay hàm tạo chuỗi mã hóa*****************************
	if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)))) {
		// Secure Hash validation succeeded, add a data field to be displayed
		// later.
		$hashValidated = "CORRECT";
	} else {
		// Secure Hash validation failed, add a data field to be displayed
		// later.
		$hashValidated = "INVALID HASH";
	}
} else {
	// Secure Hash was not validated, add a data field to be displayed later.
	$hashValidated = "INVALID HASH";
}

// Define Variables
// ----------------
// Extract the available receipt fields from the VPC Response
// If not present then let the value be equal to 'No Value Returned'
// Standard Receipt Data
$amount = null2unknown ( $_REQUEST ["vpc_Amount"] );
$locale = null2unknown ( $_REQUEST ["vpc_Locale"] );
//$batchNo = null2unknown ( $_REQUEST ["vpc_BatchNo"] );
$command = null2unknown ( $_REQUEST ["vpc_Command"] );
//$message = null2unknown ( $_REQUEST ["vpc_Message"] );
$version = null2unknown ( $_REQUEST ["vpc_Version"] );
//$cardType = null2unknown ( $_REQUEST ["vpc_Card"] );
$orderInfo = null2unknown ( $_REQUEST ["vpc_OrderInfo"] );
//$receiptNo = null2unknown ( $_REQUEST ["vpc_ReceiptNo"] );
$merchantID = null2unknown ( $_REQUEST ["vpc_Merchant"] );
//$authorizeID = null2unknown ( $_REQUEST ["vpc_AuthorizeId"] );
$merchTxnRef = null2unknown ( $_REQUEST ["vpc_MerchTxnRef"] );
$transactionNo = null2unknown ( $_REQUEST ["vpc_TransactionNo"] );
//$acqResponseCode = null2unknown ( $_REQUEST ["vpc_AcqResponseCode"] );
$txnResponseCode = null2unknown ( $_REQUEST ["vpc_TxnResponseCode"] );

// This is the display title for 'Receipt' page 
//$title = $_REQUEST ["Title"];


// This method uses the QSI Response code retrieved from the Digital
// Receipt and returns an appropriate description for the QSI Response Code
//
// @param $responseCode String containing the QSI Response Code
//
// @return String containing the appropriate description
//
//////////////////////// CONFIRM /////////////////////
if($hashValidated=="CORRECT"){
	echo "responsecode=1&desc=confirm-success";
}
else echo "responsecode=0&desc=confirm-fail";

/////////////////////////////////////////////////////
//  ----------------------------------------------------------------------------

$transStatus = "";
if($hashValidated=="CORRECT" && $txnResponseCode=="0"){
	$transStatus = "Giao dịch thành công";
}elseif ($txnResponseCode!="0"){
	$transStatus = "Giao dịch thất bại";
}elseif ($hashValidated=="INVALID HASH"){
	$transStatus = "Giao dịch Pendding";
}

function getResponseDescription($responseCode) {
	
	switch ($responseCode) {
		case "0" :
			$result = "Giao dịch thành công - Approved";
			break;
		case "1" :
			$result = "Ngân hàng từ chối giao dịch - Bank Declined";
			break;
		case "3" :
			$result = "Mã đơn vị không tồn tại - Merchant not exist";
			break;
		case "4" :
			$result = "Không đúng access code - Invalid access code";
			break;
		case "5" :
			$result = "Số tiền không hợp lệ - Invalid amount";
			break;
		case "6" :
			$result = "Mã tiền tệ không tồn tại - Invalid currency code";
			break;
		case "7" :
			$result = "Lỗi không xác định - Unspecified Failure ";
			break;
		case "8" :
			$result = "Số thẻ không đúng - Invalid card Number";
			break;
		case "9" :
			$result = "Tên chủ thẻ không đúng - Invalid card name";
			break;
		case "10" :
			$result = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
			break;
		case "11" :
			$result = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
			break;
		case "12" :
			$result = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
			break;
		case "13" :
			$result = "Vượt quá hạn mức thanh toán - Exist Amount";
			break;
		case "21" :
			$result = "Số tiền không đủ để thanh toán - Insufficient fund";
			break;
		case "99" :
			$result = "Người sủ dụng hủy giao dịch - User cancel";
			break;
		default :
			$result = "Giao dịch thất bại - Failured";
	}
	return $result;
}

//  -----------------------------------------------------------------------------
// If input is null, returns string "No Value Returned", else returns input
function null2unknown($data) {
	if ($data == "") {
		return "No Value Returned";
	} else {
		return $data;
	}
}




?>
