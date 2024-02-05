<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/fastkart/email-templete/order-success.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jun 2023 02:32:30 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <title>Online Marketplace | Order Success </title>

    

    <style type="text/css">
        body {
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: 'Public Sans', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            display: inline-block;
            text-decoration: unset;
        }

        a {
            text-decoration: none;
        }

        h5 {
            margin: 10px;
            color: #777;
        }

        .text-center {
            text-align: center
        }

        .main-bg-light {
            background-color: #fafafa;
        }

        .header-menu ul li a {
            font-size: 14px;
            color: #252525;
            font-weight: 500;
        }

        .product-table tbody tr td img {
            /* width: 86%; */
            margin-right: 26px;
        }

        .product-table tbody tr td .product-detail {
            text-align: left;
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .product-table tbody tr td .product-detail li {
            display: block;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            white-space: nowrap;
        }

        .product-table tbody tr td .product-detail li span {
            color: #939393;
        }

        .order-table {
            background-image: url(images/order-poster.jpg);
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 5px;
            overflow: hidden;
            padding: 18px 27px;
            margin-top: 40px;
        }

        .footer-table {
            position: relative;
            margin-top: 34px;
        }

        .footer-table::before {
            position: absolute;
            content: "";
            background-image: url(images/footer-left.svg);
            background-position: top right;
            top: 0;
            left: -71%;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            z-index: -1;
            background-size: contain;
            opacity: 0.3;
        }

        .footer-table::after {
            position: absolute;
            content: "";
            background-image: url(images/footer-right.svg);
            background-position: top right;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            z-index: -1;
            background-size: contain;
            opacity: 0.3;
        }
    </style>
</head>

<body style="margin: 20px auto;">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
        style="background-color: #fff; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);-webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
        <tbody>
            <tr>
                <td>
                    

                    

                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="padding: 0 27px;">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="title title-2 text-center">
                                        <h2 style="font-size: 20px;font-weight: 700;margin: 24px 0 0;">Thanks For your
                                            Order
                                        </h2>
                                        <p
                                            style="font-size: 14px;margin: 5px auto 0;line-height: 1.5;color: #939393;font-weight: 500;width: 70%;">
                                            You'll receive an email when your items are shipped. if you have any
                                            questions, Call Us 0770000007.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="dilivery-table" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="margin: 25px 27px;padding: 20px 32px;width: fit-content; background-color:
                        #f7f7f7;">
                        <tbody>
                            <tr>
                                <td
                                    style="    text-align: left;padding-right: 28px;border-right: 2px solid rgba(217, 217, 217, 0.5);">
                                    <div class="title title-2" style="text-align: left;">
                                        <h2 style="font-size: 16px;font-weight: 700;margin: 0 0 12px;">Thanks For your
                                            Order</h2>
                                        <p
                                            style="font-size: 14px;margin: 0;line-height: 1.5;color: #939393;font-weight: 500;">
                                            {{$mailData['address']}}</p>
                                    </div>
                                </td>

                                <td style="    text-align: left;padding-left: 32px;">
                                    <div class="title title-2" style="text-align: left;">
                                        <h2 style="font-size: 16px;font-weight: 700;margin: 0 0 12px;">Thanks For your
                                            Order</h2>
                                        <p
                                            style="font-size: 14px;margin: 0;line-height: 1.5;color:#939393;font-weight: 500;">
                                            You'll receive an email when your items are shipped. if you have any
                                            questions, Call Us 0770000007.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="shipping-table" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="padding: 0 27px;">
                        <thead>
                            <tr>
                                <th
                                    style="font-size: 17px;font-weight: 700;padding-bottom: 8px;border-bottom: 1px solid rgba(217, 217, 217, 0.5);text-align: left;">
                                    Order Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                style="column-count: 2;column-rule-style: dashed;column-rule-color: rgba(82, 82, 108, 0.7);column-gap: 22px;column-rule-width: 1px;display: flex;align-items: center;">
                                <td style="width: 100%;">
                                    <table class="product-table" align="center" border="0" cellpadding="0"
                                        cellspacing="0" width="100%">
                                        @php
                                            $total=0;
                                        @endphp
                                        <tbody>
                                            @forelse ($mailData['products'] as $product )
                                                <tr>
                                                    
                                                    <td
                                                        style="padding: 28px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                        <ul class="product-detail">
                                                            <li>{{ $product->product_name }}</li>
                                                            <li>QTY: <span>{{ $product->quantity}}</span></li>
                                                            <li>Price: <span>${{ $product->selling_price * $product->quantity }}</span></li>
                                                            @php
                                                                $total+=$product->selling_price * $product->quantity;
                                                            @endphp
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @empty
                                                
                                            @endforelse
                                            
                                        </tbody>
                                    </table>
                                </td>

                                <td style="width: 70%;">
                                    <table class="dilivery-table" align="center" border="0" cellpadding="0"
                                        style="background-color: #F7F7F7;padding: 14px;" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: 700;font-size: 17px;padding-bottom: 15px;border-bottom: 1px solid rgba(217, 217, 217, 0.5);"
                                                    colspan="2">Order summary</td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td
                                                    style="text-align: left;font-size: 15px;font-weight: 600;padding-top: 15px;">
                                                    Tax</td>
                                                <td
                                                    style="text-align: right;font-size: 15px;font-weight: 600;padding-top: 15px;">
                                                    ${{ $total*0.15 }}</td>
                                            </tr>
                                                
                                            <tr>
                                                <td
                                                    style="text-align: left;font-size: 15px;font-weight: 600;padding-top: 15px;">
                                                    Total</td>
                                                <td
                                                    style="text-align: right;font-size: 15px;font-weight: 600;padding-top: 15px;">
                                                    ${{ $total*(config('settings.tax')+1) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <table class="text-center footer-table" align="center" border="0" cellpadding="0" cellspacing="0"
                        width="100%"
                        style="background-color: #282834; color: white; padding: 24px; overflow: hidden; z-index: 0;">
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon text-center"
                                    align="center" style="margin: 8px auto 20px;">
                                    <tr>
                                        <td style="font-size: 19px; font-weight: 700;">Regards <span
                                                class="theme-color">{{ config('app.name') }}</span></td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon text-center"
                                    align="center" style="margin: 8px auto 20px;">
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0)"
                                                style="font-size: 14px; font-weight: 600; color: #fff; text-decoration: underline; text-transform: capitalize;">Contact
                                                Us</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)"
                                                style="font-size: 14px; font-weight: 600; color: #fff; text-decoration: underline; text-transform: capitalize; margin-left: 20px;">unsubscribe</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)"
                                                style="font-size: 14px; font-weight: 600; color: #fff; text-decoration: underline; text-transform: capitalize; margin-left: 20px;">privacy
                                                Policy</a>
                                        </td>
                                    </tr>
                                </table>
                                
                               
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>



</html>