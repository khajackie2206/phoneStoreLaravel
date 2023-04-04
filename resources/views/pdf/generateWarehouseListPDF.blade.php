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
            margin: 0px 0 50px 0;
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
        <img style="height: 18px" src="images/allo.png" style="width: 200x; height: 70px;">
        <span class="col-12 footer-thanks" style="text-align: center; margin-bottom: 200px; margin-top: -50px;">
            <h2>
                Danh sách phiếu nhập kho
            </h2>
            <!-- /.col -->
        </span>
        <div style="text-align: center; margin-top: -20px;font-size:9pt; "><span style="text-decoration: underline;">
                Vui lòng kiểm tra thông tin các phiếu nhập</span>
        </div>
    </div>

    <table class="invoice-info-container" style="font-size: 12px;margin-bottom: 30px;">
        <tr>
            <td>
                Nhân viên xuất danh sách: <strong>{{ $user->name }}</strong>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Ngày xuất: <strong>{{ $time }}</strong>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Tổng số phiếu nhập: <strong>{{ count($warehouseReceipts) }}</strong>
            <td>

            </td>
        </tr>
    </table>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap" border="1" style="font-size: 9pt;text-align:center;">
            <thead>
                <tr>
                    <th style="padding: 5px;">ID</th>
                    <th style="width: 100px; padding: 5px;">Người nhập</th>
                    <th style="width: 120px; padding: 5px;">Tổng tiền</th>
                    <th style="width: 100px;">Ngày nhập</th>
                    <th style="width: 100px;padding: 5px;">Nhà cung cấp</th>
                    <th style="padding: 5px;">Ghi chú</th>
                    <th style="width: 110px;">Trạng thái</th>
                </tr>
            </thead>
            <tbody style="font-size: 8pt;">
                @foreach ($warehouseReceipts as $warehouseReceipt   )

                <tr>
                    <td>{{ $warehouseReceipt->id}}</td>
                    <td>{{ $warehouseReceipt->admin->name}}</td>
                    <td>{{ number_format($warehouseReceipt->total) . ' VNĐ' }}</td>
                    <td><span class="tag tag-success">{{ $warehouseReceipt->created_at}}</span></td>
                    <td>{{ $warehouseReceipt->supplier->name}}</td>
                    <td>{{ $warehouseReceipt->note }}</td>
                    <td style="padding-right: 25px;">{{ $warehouseReceipt->status == 0 ? "Chờ xác nhận" : "Đã nhập kho"}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="footer-info">
            <span>khajackie2206@gmail.com</span> |
            <span>(+84) 911603179</span> |
        </div>
    </div>
</body>

</html>
