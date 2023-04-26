<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }


        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        @media screen and (max-width: 680px) {
            .mobile-hide {
                display: none !important;
            }

            .mobile-center {
                text-align: center !important;
            }
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>

<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">


    <div
        style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        For what reason would it be advisable for me to think about business content? That might be little bit risky to
        have crew member like them.
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width:800px;">
                    <tr>
                        <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#F44336">

                            <div
                                style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                    style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top"
                                            style="font-family: sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;"
                                            class="mobile-center">
                                            <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;">
                                                Allo Store</h1>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;"
                                class="mobile-hide">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                    style="max-width:300px;">
                                    <tr>
                                        <td align="right" valign="top"
                                            style="font-family: sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                            <table cellspacing="0" cellpadding="0" border="0" align="right">

                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;"
                            bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="max-width:800px;">
                                <tr>
                                    <td align="center"
                                        style="font-family: Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                        <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png"
                                            width="125" height="120" style="display: block; border: 0px;" /><br>
                                        <h2
                                            style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                            Cảm ơn quý khách đã đặt hàng
                                        </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left"
                                        style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                        <p
                                            style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                            Quý khách vui lòng kiểm tra thông tin đơn hàng:
                                        </p>
                                    </td>
                                </tr>
                                <?php
                                   $sub = 0;
                                ?>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="75%" align="left" bgcolor="#eeeeee"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                    Sản phẩm #
                                                </td>
                                                <td width="25%" align="left" bgcolor="#eeeeee"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                    Thành tiền
                                                </td>
                                            </tr>
                                            @foreach ($products as $product)
                                                <?php
                                                    $sub += ($product->price - $product->discount) * $carts[$product->id];
                                                ?>
                                                <tr>
                                                    <td width="75%" align="left"
                                                        style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                        {{ $product->name }} {{ $product->rom}} - {{ $product->color}} x {{ $carts[$product->id] }}
                                                    </td>
                                                    <td width="25%" align="left"
                                                        style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                        {{ number_format(($product->price - $product->discount) * $carts[$product->id]) }}
                                                        <span style="text-decoration: underline;"> đ</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td width="75%" align="left"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                    Giảm giá:
                                                </td>
                                                <td width="25%" align="left"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                    @if ($discount != null)
                                                       @if ($typeDiscount == "percent")
                                                        -{{ number_format($sub * $discount/ 100) }}
                                                        @else
                                                         -{{ number_format($discount) }}
                                                       @endif
                                                   @else
                                                          0
                                                    @endif
                                                    <span style="text-decoration: underline;">đ</span>
                                            </tr>
                                            <tr>
                                                <td width="75%" align="left"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                    Phí giao hàng:
                                                </td>
                                                <td width="25%" align="left"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                     30,000
                                                    <span style="text-decoration: underline;">đ</span>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="70%" align="left"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                                    Tổng cộng
                                                </td>
                                                <td width="30%" align="center"
                                                    style="font-family: sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee; padding-right: 15px;">
                                                    {{ number_format($summary) }} <span
                                                        style="text-decoration: underline;"> đ</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td align="left" height="100%" valign="top" width="100%"
                            style="padding: 0 35px 0px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="max-width:660px;">
                                <tr>
                                    <td align="left" valign="top" style="font-size:0;">
                                        <div
                                            style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                            <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                width="100%" style="max-width:300px;">
                                                <tr>
                                                    <td align="left" valign="top"
                                                        style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                        <p style="font-weight: 800;">Địa chỉ giao hàng</p>
                                                        <p>{{ $address }}</p>

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                     <td align="left" valign="top" style="font-size:0;">
                                        <div
                                            style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                            <table align="left" border="0" cellpadding="0" cellspacing="0"
                                                width="100%" style="max-width:300px;">
                                                <tr>
                                                    <td align="left" valign="top"
                                                        style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                        <p style="font-weight: 800;">Số điện thoại giao hàng</p>
                                                        <p>0911603179</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="font-size:0;">
                                        <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                <tr>
                                                    <td align="left" valign="top"
                                                        style="font-family: sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                        <p style="font-weight: 800;">Phương thức thanh toán</p>
                                                        <p><span class="ms-1">
                                                            @if ($paymentMethod == 1)
                                                            <span class="badge bg-success" style="font-size: 16px;">Trả khi nhận hàng</span>
                                                            @elseif ($paymentMethod == 3)
                                                            <span class="badge bg-warning" style="font-size: 16px;"><img
                                                                    src="https://logos-world.net/wp-content/uploads/2020/07/PayPal-Logo.png" style="margin-right: 10px;"
                                                                    width="50px">Thanh toán Paypal</span>
                                                            @elseif ($paymentMethod == 2)
                                                            <span class="badge bg-warning" style="font-size: 16px; padding: 10px;"><img
                                                                    src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR.png" style="margin-right: 10px;"
                                                                    width="50px">Thanh toán VNPay</span>
                                                            @endif
                                                        </span></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="max-width:600px;">
                                <tr>
                                    <td align="left"
                                        style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                        <p
                                            style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
                                            Mọi thắc mắc xin vui lòng liên hệ qua số điện thoại 0911603179,
                                            hoặc qua <a href="https://www.facebook.com/kha.nguyenminh.547/"
                                                target="_blank" style="color: #777777;">facebook</a>.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
