<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Virtual Payment Client Example</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf8'>
<style type="text/css">
<!--
h1 {
	font-family: Arial, sans-serif;
	font-size: 24pt;
	color: #08185A;
	font-weight: 100
}

h2.co {
	font-family: Arial, sans-serif;
	font-size: 24pt;
	color: #08185A;
	margin-top: 0.1em;
	margin-bottom: 0.1em;
	font-weight: 100
}

h3.co {
	font-family: Arial, sans-serif;
	font-size: 16pt;
	color: #000000;
	margin-top: 0.1em;
	margin-bottom: 0.1em;
	font-weight: 100
}

body {
	font-family: Verdana, Arial, sans-serif;
	font-size: 10pt;
	color: #08185A background-color : #FFFFFF
}

a:link {
	font-family: Verdana, Arial, sans-serif;
	font-size: 8pt;
	color: #08185A
}

a:visited {
	font-family: Verdana, Arial, sans-serif;
	font-size: 8pt;
	color: #08185A
}

a:hover {
	font-family: Verdana, Arial, sans-serif;
	font-size: 8pt;
	color: #FF0000
}

a:active {
	font-family: Verdana, Arial, sans-serif;
	font-size: 8pt;
	color: #FF0000
}

.shade {
	height: 25px;
	background-color: #CED7EF
}

tr.title {
	height: 25px;
	background-color: #0074C4
}

td {
	font-family: Verdana, Arial, sans-serif;
	font-size: 8pt;
	color: #08185A
}

th {
	font-family: Verdana, Arial, sans-serif;
	font-size: 10pt;
	color: #08185A;
	font-weight: bold;
	background-color: #CED7EF;
	padding-top: 0.5em;
	padding-bottom: 0.5em
}



.background-image {
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size: 12px;
	width: 100%;
	text-align: left;
	border-collapse: collapse;
	background: url("...") 330px 59px no-repeat;
	margin: 0px;
}

.background-image th {
	font-weight: normal;
	font-size: 14px;
	color: #339;
	padding: 12px;
}

.background-image td {
	color: #669;
	border-top: 1px solid #fff;
	padding: 9px 12px;
}

.background-image tfoot td {
	font-size: 11px;
}

.background-image tbody td {
	background: url("./back.png");
}

* html 
.background-image tbody td {
	filter: progid : DXImageTransform.Microsoft.AlphaImageLoader ( src =
		'table-images/back.png', sizingMethod = 'crop' );
	background: none;
}

.background-image tbody tr:hover td {
	color: #339;
	background: none;
}

.background-image .tb_title{
	font-family: Verdana, Arial, sans-serif;
	color: #08185A;
	background-color: #CED7EF;
	font-size: 14px;
	color: #339;
	padding: 12px;
}
-->
</style>
</head>
<body>
<?php
    date_default_timezone_set('Asia/Krasnoyarsk');
?>
<table width='100%' border='2' cellpadding='2' bgcolor='#0074C4'>
	<tr>
		<td bgcolor='#CED7EF' width='90%'>
		<h2 class='co'>&nbsp;Payment Client Example</h2>
		</td>
		<td bgcolor='#0074C4' align='center'>
		<h3 class='co'>OnePAY</h3>
		</td>
	</tr>
</table>
<form action="./do.php" method="post">
    <input type="hidden" name="Title" value="VPC 3-Party" />
<table width="100%" align="center" border="0" cellpadding='0'
	cellspacing='0'>
	<tr class="shade">
		<td width="1%">&nbsp;</td>
		<td width="40%" align="right"><strong><em>URL cổng thanh toán - Virtual Payment Client
		URL:&nbsp;</em></strong></td>
		<td width="59%"><input type="text" name="virtualPaymentClientURL"
			size="63" value="https://mtf.onepay.vn/onecomm-pay/vpc.op"
			maxlength="250" /></td>
	</tr>
</table>
<center>
<table class="background-image" summary="Meeting Results">
	<thead>
		<tr>
			<th scope="col" width="250px">Name</th>
			<th scope="col" width="250px">Input</th>
			<th scope="col" width="250px">Chú thích</th>
            <th scope="col">Description</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong><em>Merchant ID</em></strong></td>
			<td><input type="text" name="vpc_Merchant" value="ONEPAY" size="20"
				maxlength="16" /></td>
			<td>Được cấp bởi OnePAY</td>
            <td>Provided by OnePAY</td>
		</tr>
		<tr>
			<td><strong><em>Merchant AccessCode</em></strong></td>
			<td><input type="text" name="vpc_AccessCode" value="D67342C2"
				size="20" maxlength="8" /></td>
			<td>Được cấp bởi OnePAY</td>
            <td>Provided by OnePAY</td>
		</tr>
		<tr>
			<td><strong><em>Merchant Transaction Reference</em></strong></td>
			<td><input type="text" name="vpc_MerchTxnRef"
				value="<?php
				echo date ( 'YmdHis' ) . rand ();
				?>" size="20"
				maxlength="40" /></td>
			<td>ID giao dịch, giá trị phải khác nhau trong mỗi lần thanh(tối đa 40 ký tự)
			toán</td>
            <td>ID Transaction - (unique per transaction) - (max 40 char)</td>
		</tr>
		<tr>
			<td><strong><em>Transaction OrderInfo</em></strong></td>
			<td><input type="text" name="vpc_OrderInfo" value="JSECURETEST01"
				size="20" maxlength="34" /></td>
			<td>Tên hóa đơn - (tối đa 34 ký tự)</td>
            <td>Order Name will show on payment gateway (max 34 char)</td>
		</tr>
		<tr>
			<td><strong><em>Purchase Amount</em></strong></td>
			<td><input type="text" name="vpc_Amount" value="100" size="20"
				maxlength="10" /></td>
			<td>Số tiền cần thanh toán,Đã được nhân với 100. VD: 100=1VND</td>
            <td>Amount,Multiplied with 100, Ex: 100=1VND</td>
		</tr>
		<tr>
			<td><strong><em>Receipt ReturnURL</em></strong></td>
			<td><input type="text" name="vpc_ReturnURL" size="45"
				value="http://localhost/domestic_php_v2/source_code/dr.php"
				maxlength="250" /></td>
			<td>Url nhận kết quả trả về sau khi giao dịch hoàn thành.</td>
            <td>URL for receiving payment result from gateway</td>
		</tr>
		<tr>
			<td><strong><em>VPC Version</em></strong></td>
			<td><input type="text" name="vpc_Version" value="2" size="20"
				maxlength="8" /></td>
			<td>Phiên bản modul (cố định)</td>
            <td>Version (fixed)</td>
		</tr>
		<tr>
			<td><strong><em>Command Type</em></strong></td>
			<td><input type="text" name="vpc_Command" value="pay" size="20"
				maxlength="16" /></td>
			<td>Loại request (cố định)</td>
            <td>Command Type(fixed)</td>
		</tr>
		<tr>
			<td><strong><em>Payment Server Display Language Locale</em></strong></td>
			<td><input type="text" name="vpc_Locale" value="vn" size="20"
				maxlength="5" /></td>
			<td>Ngôn ngữ hiện thị trên cổng (vn/en)</td>
            <td>Language use on gateway (vn/en)</td>
		</tr>
		<tr>
			<td><strong><em>Currency code</em></strong></td>
			<td><input type="text" name="vpc_Currency" value="VND" size="20"
				maxlength="5" /></td>
			<td>Loại tiền tệ (VND)</td>
            <td>Currency (VND)</td>
		</tr>
	</tbody>
</table>
<table class="background-image" summary="Meeting Results">
	<thead>
		<tr>
			<th scope="col" colspan="4">Addition Infomation</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td align="center" colspan="4"><input type="submit"	value="Pay Now!" /></td>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<td width="250px"><strong><em>IP address</em></strong></td>
			<td width="300px"><input type="text" name="vpc_TicketNo" maxlength="15"
				value="<?php
			echo $_SERVER ['REMOTE_ADDR'];
			?>" /></td>
			<td width="250px">IP khách hàng</td>
            <td>IP Client</td>
		</tr>
		<tr>
			<td><strong><em>Shipping Address</em></strong></td>
			<td><input type="text" name="vpc_SHIP_Street01" value="39A Ngo Quyen" size="20"
				maxlength="500" /></td>
			<td>Địa chỉ gửi hàng</td>
            <td>Shipping Address</td>
		</tr>
		<tr>
			<td><strong><em>Shipping Province</em></strong></td>
			<td><input type="text" name="vpc_SHIP_Provice" value="Hoan Kiem"
				size="20" maxlength="50" /></td>
			<td>Quận Huyện(địa chỉ gửi hàng)</td>
            <td>Shipping Province</td>
		</tr>
		<tr>
			<td><strong><em>Shipping City</em></strong></td>
			<td><input type="text" name="vpc_SHIP_City"
				value="Ha Noi" size="20"
				maxlength="50" /></td>
			<td>Tỉnh/thành phố (địa chỉ khách hàng)</td>
            <td>Shipping City</td>
		</tr>
		<tr>
			<td><strong><em>Shipping Country</em></strong></td>
			<td><input type="text" name="vpc_SHIP_Country" value="Viet Nam"
				size="20" maxlength="50" /></td>
			<td>Quốc gia(địa chỉ khách hàng)</td>
            <td>Shipping Country</td>
		</tr>
		<tr>
			<td><strong><em>Customer Phone</em></strong></td>
			<td><input type="text" name="vpc_Customer_Phone" value="840904280949" size="20"
				maxlength="50" /></td>
			<td>Số điện thoại khách hàng</td>
            <td>Customer Phone</td>
		</tr>
		<tr>
			<td><strong><em>Customer email</em></strong></td>
			<td><input type="text" name="vpc_Customer_Email" size="20"
				value="support@onepay.vn"
				maxlength="50" /></td>
			<td>Địa chỉ hòm thư của khách hàng</td>
            <td>Customer email</td>
		</tr>
		<tr>
			<td><strong><em>Customer User Id</em></strong></td>
			<td><input type="text" name="vpc_Customer_Id" value="thanhvt" size="20"
				maxlength="50" /></td>
			<td>Tên tài khoản khách hàng trên hệ thống</td>
            <td>Customer User Id</td>
		</tr>
		<tr>
			<td><strong><em>Note</em></strong></td>
			<td colspan="2">-  Không sử dụng tiếng việt có dấu trong các tham số gửi sang cổng thanh toán<br>-	Không sử dụng số tiền lẻ với cổng thanh toán test(ví dụ 0.2 đồng tức amount = 20)</td>
            <td colspan="1">-  do not use vietnamese with sign. Convert to vietnamese no sign before send it to gateway<br>-	do not use decimal for amount for testing (100=1VND -> right; 120=1.2VND -> wrong)</td>
		</tr>
	</tbody>
</table>
</center>
</form>
</body>
</html>
