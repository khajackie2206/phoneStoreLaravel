<!DOCTYPE html>

<head>
    <html lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <style>
        /*
  Common invoice styles. These styles will work in a browser or using the HTML
  to PDF anvil endpoint.
*/

        body {
            font-size: 16px;
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td {
            padding: 0;
        }

        table tr td:last-child {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .large {
            font-size: 1.10em;
            font-weight: bold;
        }

        .total {
            font-weight: bold;
            color: #fb7578;
        }

        .logo-container {
            margin: 20px 0 70px 0;
        }

        .invoice-info-container {
            font-size: 0.875em;
        }

        .invoice-info-container td {
            padding: 4px 0;
        }

        .client-name {
            font-size: 1.5em;
            vertical-align: top;
        }

        .line-items-container {
            margin: 70px 0;
            font-size: 0.875em;
        }

        .line-items-container th {
            text-align: left;
            color: #999;
            border-bottom: 2px solid #ddd;
            padding: 10px 0 15px 0;
            font-size: 0.75em;
            text-transform: uppercase;
        }

        .line-items-container th:last-child {
            text-align: right;
        }

        .line-items-container td {
            padding: 5px 0;
        }

        .line-items-container tbody tr:first-child td {
            padding-top: 2px;
        }

        .line-items-container.has-bottom-border tbody tr:last-child td {
            padding-bottom: px;
            border-bottom: 2px solid #ddd;
        }

        .line-items-container.has-bottom-border {
            margin-bottom: 0;
        }

        .line-items-container th.heading-quantity {
            width: 100px;
             text-align: right;
        }

        .line-items-container th.heading-price {
            text-align: right;
            padding-right: 30px;
            width: 150px;
        }

        .line-items-container th.heading-description {
            width: 230px;
        }

        .line-items-container th.heading-subtotal {
            width: 200px;
        }

        .payment-info {
            width: 38%;
            font-size: 0.75em;
        }

        .footer {
            margin-top: 100px;
        }

        .footer-thanks {
            font-size: 1.125em;
        }

        .footer-thanks img {
            display: inline-block;
            position: relative;
            top: 1px;
            width: 16px;
            margin-right: 4px;
        }

        .footer-info {
            float: right;
            margin-top: 5px;
            font-size: 0.75em;
            color: #ccc;
        }

        .footer-info span {
            padding: 0 5px;
            color: black;
        }

        .footer-info span:last-child {
            padding-right: 0;
        }

        .page-container {
            display: none;
        }
    </style>
</head>

<body>
    <div class="page-container">
        Page
        <span class="page"></span>
        of
        <span class="pages"></span>
    </div>

    <div class="logo-container">
        <img style="height: 18px" src="images/allo.png" style="width: 250x; height: 80px;">
        <span class="col-12 footer-thanks" style="text-align: center; margin-bottom: 50px;">
            <h1>
                Hóa đơn mua hàng
            </h1>
            <!-- /.col -->
        </span>
        <div style="text-align: center; margin-top: -20px;font-size:9pt; "><span> Vui lòng kiểm tra thông tin hóa đơn</span></div>
    </div>
    <?php $sub = 0; ?>
    <table class="invoice-info-container" style="font-size: 13px;">
        <tr>
            <td >
                Tên khách hàng: <strong>{{ $order->user->name }}</strong>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Địa chỉ giao hàng: <strong>{{ $order->delivery_address }}</strong>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Ngày đặt hàng: <strong>{{ $order->created_at->format('d-m-Y H:i:s') }}</strong>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Đơn hàng: <strong>#0000{{ $order->id }}</strong>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                Người lập hóa đơn: <strong>{{ $user->name }}</strong>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                Thời gian lập hóa đơn: <strong>{{ $time }}</strong>
            </td>
            <td>
            </td>
        </tr>
    </table>


    <table class="line-items-container" >
        <thead>
            <tr>
                <th class="heading-description">Sản phẩm</th>
                <th class="heading-quantity">Số lượng</th>
                <th class="heading-price">Giá</th>
                <th class="heading-subtotal">Tổng cộng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $orderDetail)
                <tr>
                    <td>{{ $orderDetail->product->name }} {{ $orderDetail->product->rom }} -
                        {{ $orderDetail->product->color }}</td>
                    <td class="right" style="padding-right: 30px;">{{ $orderDetail->quantity }}</td>

                    <td class="right">
                        {{ number_format($orderDetail->product->discount > 0 ? $orderDetail->product->price - $orderDetail->product->discount : $orderDetail->product->price) }}
                        <span style="text-decoration: underline;">đ</span>
                    </td>
                    <td class="bold">
                        {{ number_format(($orderDetail->product->discount > 0 ? $orderDetail->product->price - $orderDetail->product->discount : $orderDetail->product->price) * $orderDetail->quantity) }}
                        <span style="text-decoration: underline;">đ</span>
                    </td>
                </tr>
                <?php
                $sub += ($orderDetail->product->discount > 0 ? $orderDetail->product->price - $orderDetail->product->discount : $orderDetail->product->price) * $orderDetail->quantity;
                ?>
            @endforeach
        </tbody>
    </table>


    <table class="line-items-container has-bottom-border">
        <thead>
            <tr>
                <th>Thông tin thanh toán</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr style="width: 50px;">
                <td>
                    <strong> Tạm tính: </strong>
                </td>
                <td></td>
                <td class="large">{{ number_format($sub) }} <span
                                    style="text-decoration: underline;">đ</span></td>
            </tr>
            <tr>
                <td>
                    <strong> Mã giảm: </strong>
                </td>
                <td></td>
                <td class="large">  @if ($discount != null)
                                        @if ($discount->type_discount == 'percent')
                                        {{ number_format($sub * ($discount->amount / 100)) }}
                                        @else
                                        {{ number_format($discount->amount) }}
                                        @endif
                                     @else
                                         0
                                      @endif
                                <span style="text-decoration: underline;">đ</span></td>
            </tr>
            <tr>
                <td>
                    <strong> Vận chuyển: </strong>
                </td>
                <td></td>
                <td class="large">30,000 <span style="text-decoration: underline;">đ</span></td>
            </tr>
            <tr>
                <td>
                    <strong> Tổng thanh toán: </strong>
                </td>
                <td></td>
                <td class="large total" style="font-size: 1.4em;">{{ number_format($order->total) }} <span
                                    style="text-decoration: underline;">đ</span></td>
            </tr>

        </tbody>
    </table>

    <div class="footer">
        <div class="footer-info">
            <span>khajackie2206@gmail.com</span> |
            <span>(+84) 911603179</span> |
        </div>
        <div class="footer-thanks">
            <span>Cảm ơn quý khách!</span>
        </div>
    </div>
</body>

</html>
