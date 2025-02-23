<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header h1 {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .header span {
            font-weight: 600;
        }

        .address h4 {
            color: #ef4444;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 0.5rem;
        }

        .addressbreak {
            line-height: 1.6;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .table table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            margin-top: 25px;
            page-break-inside: avoid;
        }

        .table th,
        .table td {
            padding: 8px;
            font-size: 14px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table thead {
            background-color: #ffecee;
            white-space: nowrap;
        }

        .desc {
            padding-bottom: 0.25rem;
            padding-top: 0.25rem;
            line-height: 1.6;
        }

        .amountinwords,
        .amountinwords td,
        .amountinwords th {
            border: none !important;
        }

        .amountinwordsText,
        .amountinwordsText td,
        .amountinwordsText th {
            border: none !important;
        }

        .amount {
            font-family: 'DejaVu Sans', sans-serif;
        }

        p {
            margin: 0;
            padding-bottom: 0.25rem;
        }

        .footer{
            text-align: center;
        }

        .footer h6{
            font-weight: normal;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .footer p{
            font-size: 13px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tr>
                    <td align="left" style="vertical-align: middle;">
                        <img src="{{ $logo }}" alt="Dealslah" width="200">
                    </td>
                    <td align="right" style="vertical-align: middle;" class="headerText">
                        <h1>Invoice</h1>
                        <p><span>Order Number : </span>{{ $order->order_number }}</p>
                        <p><span>Order Date : </span>{{ $order->created_at->format('Y-m-d') }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="address">
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tr>
                    <td align="left" style="vertical-align: middle;">
                        <h4>Sold By</h4>
                        <p style="margin: 0; padding: 0;">{{ $shop->name }}</p>
                        @php
                        function breakAddress($address, $limit = 25) {
                            $lines = [];
                            while (strlen($address) > $limit) {
                                $breakPoint = strrpos(substr($address, 0, $limit + 1), ' ');
                                if ($breakPoint === false) {
                                    $breakPoint = $limit;
                                }
                                $lines[] = substr($address, 0, $breakPoint);
                                $address = substr($address, $breakPoint + 1);
                            }
                            $lines[] = $address;
                            return $lines;
                        }
                        $shopAddressLines = breakAddress($shop->address);
                        @endphp
                        <p class="addressbreak">
                            @foreach ($shopAddressLines as $line)
                            {{ $line }}<br>
                            @endforeach
                        </p>
                        <p>Phone : {{ $shop->mobile }}</p>
                        <p>Email : {{ $shop->email }}</p>
                    </td>
                    <td align="right" style="vertical-align: middle;" class="headerText">
                        <h4>Bill To</h4>
                        <p style="margin: 0; padding: 0;">{{ $order->first_name }} {{ $order->last_name ?? '' }}</p>
                        @php
                        $deliveryAddress = json_decode($order->delivery_address);
                        $fullAddress = "{$deliveryAddress->street}, {$deliveryAddress->city}, {$deliveryAddress->state}, {$deliveryAddress->zipCode}";
                        $deliveryAddressLines = breakAddress($fullAddress);
                        @endphp
                        <p class="addressbreak">
                            @foreach ($deliveryAddressLines as $line)
                            {{ $line }}<br>
                            @endforeach
                        </p>
                        <p>Phone : {{ $order->mobile }}</p>
                        <p>Email : {{ $order->email }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Net Amount</th>
                        <th>Discount</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $key => $item)
                    @php
                    $netAmount = $item->deal_originalprice * $item->quantity;
                    $discount = ($item->deal_originalprice - $item->deal_price) * $item->quantity;
                    $totalAmount = $item->deal_price * $item->quantity;
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <strong>{{ $item->deal_name }}</strong>
                            <p class="desc">{{ Str::limit($item->deal_description, 85, '...') }}</p>
                        </td>
                        <td><span class="amount">$</span>{{ indian_number_format($item->deal_originalprice) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td><span class="amount">$</span>{{ indian_number_format($netAmount) }}</td>
                        <td><span class="amount">$</span>{{ indian_number_format($discount) }}</td>
                        <td><span class="amount">$</span>{{ indian_number_format($totalAmount) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: right;">Total</td>
                        <td><span class="amount">$</span>{{ indian_number_format($order->total) }}</td>
                    </tr>
                    <tr class="amountinwords">
                        <th colspan="7">Amount in Words:</th>
                    </tr>
                    <tr class="amountinwordsText">
                        <td colspan="7">{{ convertNumberToWords($order->total) }} Only</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="footer">
            <h6>Thank you for shopping with <span style="color: #ef4444;">Dealslah</span>! For assistance, contact us at info@dealslah.com.</h6>
            <p>2024 © Copyright Dealslah. All Rights Reserved.</p>
        </div>
    </div>
</body>

</html>

<?php
function indian_number_format($number) {
    // Round to two decimal places
    $number = round($number, 2);

    $number_parts = explode('.', $number);
    $integer_part = $number_parts[0];
    $decimal_part = isset($number_parts[1]) ? '.' . str_pad($number_parts[1], 2, '0') : '';
    $last_three = substr($integer_part, -3);
    $rest = substr($integer_part, 0, -3);
    if ($rest !== '') {
        $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
        return $rest . ',' . $last_three . $decimal_part;
    }
    return $last_three . $decimal_part;
}

function convertNumberToWords($number) {
    $words = array(
        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety'
    );

    $units = array(
        100 => 'Hundred',
        1000 => 'Thousand',
        100000 => 'Lakh',
        10000000 => 'Crore'
    );

    if ($number == 0) {
        return $words[0];
    }

    $number = (int)$number;
    $result = '';

    if ($number >= 10000000) {
        $crores = floor($number / 10000000);
        $result .= convertNumberToWords($crores) . ' Crore ';
        $number %= 10000000;
    }

    if ($number >= 100000) {
        $lakhs = floor($number / 100000);
        $result .= convertNumberToWords($lakhs) . ' Lakh ';
        $number %= 100000;
    }

    if ($number >= 1000) {
        $thousands = floor($number / 1000);
        $result .= convertNumberToWords($thousands) . ' Thousand ';
        $number %= 1000;
    }

    if ($number >= 100) {
        $hundreds = floor($number / 100);
        $result .= convertNumberToWords($hundreds) . ' Hundred ';
        $number %= 100;
    }

    if ($number >= 20) {
        $tens = floor($number / 10) * 10;
        $result .= $words[$tens] . ' ';
        $number %= 10;
    }

    if ($number > 0) {
        $result .= $words[$number] . ' ';
    }

    return $result;
}
?>
