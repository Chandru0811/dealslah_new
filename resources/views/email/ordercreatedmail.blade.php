<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Placed</title>
    <style>
        body {
            background-color: #f7f9fc;
            font-family: "Arial", sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 650px;
            background-color: #ffffff;
            margin: 40px auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #ef4444;
            border-bottom: 3px solid #888888;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
        }

        .header img {
            width: 120px;
        }

        .headerText a {
            font-size: 12px;
            text-decoration: none;
            color: #000;
        }

        .message {
            padding: 10px 25px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
        }

        .message a {
            color: #ef4444;
        }

        .content {
            padding: 0px 25px;
            line-height: 1.6;
        }

        .content h4 {
            color: #ef4444;
            font-size: 28px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .content p {
            font-size: 15px;
            margin-bottom: 20px;
        }

        .product-details {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .product-details h2 {
            color: #333;
            font-size: 20px;
            margin-bottom: 10px;
            margin-top: 0px;
        }

        .product-details p {
            margin: 0px;
        }

        .product-details .sub-heading span {
            color: #d32323;
        }

        .product-details .sub-heading .price {
            text-decoration: line-through;
        }

        .product-details .sold-details {
            font-size: 12px;
        }

        .cta-button {
            text-align: center;
            margin: 40px 0;
        }

        .cta-button a {
            background-color: #ef4444;
            color: #fff;
            padding: 14px 28px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(255, 153, 0, 0.2);
            transition: background-color 0.3s;
        }

        .cta-button a:hover {
            background-color: #e60050;
        }

        .footer img {
            width: 120px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header" style="padding: 25px; border-bottom: 1px solid #ddd; text-align: center;">
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tr>
                    <td align="left" style="vertical-align: middle;">
                        <img src="https://dealslah.com/assets/images/home/email_logo.png" alt="dealslah" style="max-width: 150px; height: auto;">
                    </td>
                    <td align="right" style="vertical-align: middle;">
                        <div class="headerText" style="font-size: 14px; color: #333;">
                            <a href="https://dealslah.com/dealslahVendor/" target="_blank" style="text-decoration: none; color: #333;">
                                Your <span style="color: #ef4444;">dealslah.com</span>
                            </a> |
                            <a href="tel:6588941306" target="_blank" style="text-decoration: none; color: #333;">
                                +65 88941306
                            </a> |
                            <a href="https://play.google.com/store/apps/details?id=com.dealslah.dealslah" target="_blank" style="text-decoration: none; color: #333;">
                                Get <span style="color: #ef4444;">Dealslah</span> App
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Warming Message -->
        <div class="message">
            <p>Hello {{ $shop->name }},</p>
            <p>We are excited to inform you that <strong>{{ $orderdetails->first_name }}{{ isset($orderdetails->last_name) ? ' ' . $orderdetails->last_name : '' }}</strong> has placed an order in your shop on <span style="color: #ef4444;">Dealslah</span>. You can contact the customer at <strong>Email: {{ $orderdetails->email }}</strong> or <strong>Mobile: {{ $orderdetails->mobile }}</strong>. Thank you for being a valued partner.</p>
        </div>
        <!-- Content -->
        <div class="content">
            <h4>Order Details</h4>
            <div class="product-details">
                <h2>{{$orderdetails->order_number}}</h2>
                @foreach($orderdetails->items as $item)
                <p class="sub-heading">Deal Name : {{$item->deal_name}}</p>
                <p class="sub-heading">Regular Price : <span class="price">₹{{ number_format($item->deal_originalprice, 2) }}</span></p>
                <p class="sub-heading">Offer Price: <span>₹{{ number_format($item->deal_price, 2) }}</span></p>
                <p class="sub-heading">Discount Percentage : <span>{{ number_format($item->discount_percentage, 0) }}%</span></p>
                <p class="sub-heading">Coupon Code : <span>{{$item->coupon_code}}</span></p>
                <p class="sub-heading">Quantity: <span>{{$item->quantity}}</span></p>
                <!-- <p class="sub-heading">Service Date: <span>18-11-2024</span></p>
                <p class="sub-heading">Service Time: <span>06.00 PM</span></p> -->
                @php
                    $total_price = $item->deal_price * $item->quantity;
                @endphp
                <p class="sub-heading">Total Price: <span>₹{{$total_price}}</span></p>
                @endforeach
                <p class="sold-details">Sold by <span style="color: #1a0dab;">{{ $shop->legal_name }}</span> and
                    Fulfilled by <a href="https://dealslah.com/dealslahVendor/" target="_blank"
                        style="color: #ef4444; text-decoration: none;">Dealslah</a></p>
            </div>
            <div class="cta-button">
                <a href="https://dealslah.com/dealslahVendor/" target="_blank">Go to Dashboard</a>
            </div>
            <p style="border-bottom: 1px solid #c2c2c2; margin-bottom: 0px;"></p>
        </div>
        <!-- Footer -->
        <div class="footer" style="padding: 15px 25px; text-align: center;">
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tr>
                    <td align="left" style="vertical-align: middle;">
                        <img src="https://dealslah.com/assets/images/home/email_logo.png" alt="dealslah" style="max-width: 150px; height: auto; margin-bottom: 10px;">
                    </td>
                    <td align="right" style="vertical-align: middle;">
                        <p style="font-size: 12px; color: #333; margin: 0;">
                            Connect with <a href="https://dealslah.com/dealslahVendor/" target="_blank" style="color: #ef4444; text-decoration: none;">Dealslah</a> India
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>