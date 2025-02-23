<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
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

        .content {
            padding: 10px 25px;
        }

        .content a {
            color: #ef4444;
        }

        .content p{
            font-size: 14.5px;
            line-height: 1.6;
        }

        .otp {
            text-align: center;
            margin: 40px 0;
            font-size: 24px !important;
            font-weight: 750 !important;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
        }

        .footer img {
            width: 120px;
        }

        .footer p{
            font-size: 12px;
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
                        <img src="https://dealsmachi.com/assets/images/home/email_logo.png" alt="Deals Machi" style="max-width: 150px; height: auto;">
                    </td>
                    <td align="right" style="vertical-align: middle;">
                        <div class="headerText" style="font-size: 14px; color: #333;">
                            <a href="https://dealsmachi.com/" target="_blank" style="text-decoration: none; color: #333;">
                                Your <span style="color: #ef4444;">dealsmachi.com</span>
                            </a> |
                            <a href="tel:919150150687 " target="_blank" style="text-decoration: none; color: #333;">
                                +91 9150150687
                            </a> |
                            <a href="https://play.google.com/store/apps/details?id=com.dealsmachi.dealsmachi" target="_blank" style="text-decoration: none; color: #333;">
                                Get <span style="color: #ef4444;">DealsMachi</span> App
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Content -->
        <div class="content">
            <p style="font-size: 24px; font-weight: 750; margin-bottom: 0px;">Hello {{$name}},</p>
            <p style="margin-bottom: 0px !important;">We received a request to reset your password. Use the OTP below to reset your password, your DealsMachi OTP-{{$otp}}.</p>
            <p style="margin-top: 0px !important;">If you did not request a password reset, please ignore this email. Your password will not be changed.</p>
            <p style="border-bottom: 1px solid #c2c2c2; margin-bottom: 0px;"></p>
        </div>

        <!-- Footer -->
        <div class="footer" style="padding: 15px 25px; text-align: center;">
            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                <tr>
                    <td align="left" style="vertical-align: middle;">
                        <img src="https://dealsmachi.com/assets/images/home/email_logo.png" alt="dealsmachi" style="max-width: 150px; height: auto; margin-bottom: 10px;">
                    </td>
                    <td align="right" style="vertical-align: middle;">
                        <p style="font-size: 12px; color: #333; margin: 0;">
                            Connect with <a href="https://dealsmachi.com/" target="_blank" style="color: #ef4444; text-decoration: none;">DealsMachi</a> India
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
