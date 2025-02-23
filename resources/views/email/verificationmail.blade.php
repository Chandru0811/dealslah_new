<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Verification</title>
    <style>
        body {
            background-color: #f7f9fc;
            font-family: "Arial", sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 650px;
            background-color: #ffffff;
            margin: 40px auto;
            padding: 35px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-bottom: 5px solid #ef4444;
        }

        .header {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 2px solid #c2c2c2;
        }

        .header img {
            width: 160px;
            margin-bottom: 15px;
        }

        .content {
            padding: 20px 0;
            line-height: 1.6;
        }

        .content h1 {
            color: #ef4444;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .content p {
            font-size: 15px;
            margin-bottom: 20px;
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
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.2);
            transition: background-color 0.3s;
        }

        .cta-button a:hover {
            background-color: #cc3b3b;
        }

        .footer {
            margin-top: 30px;
            text-align: left;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .footer p {
            margin: 8px 0;
            font-size: 14px;
            color: #555;
        }

        .footer a {
            color: #ef4444;
            text-decoration: none;
        }

        .footer .signature {
            font-size: 15px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="https://dealslah.com/assets/images/home/email_logo.png" alt="dealslah Pte Ltd" />
        </div>

        <!-- Content -->
        <div class="content">
            <h1>Welcome to Dealslah!</h1>
            <p>Thank you for registering with us. To complete your registration, please verify your email address by clicking the button below.</p>

            <div class="cta-button">
                <a href="{{$verifylink}}" target="_blank">Verify Your Email</a>
            </div>

            <p>If you did not create an account, please ignore this email.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="signature">Warm Regards,</p>
            <p>Team Dealslah Pte Ltd</p>
            <p>Email: <a href="mailto:info@dealslah.com" mailto:target="_blank">info@dealslah.com</a></p>
            <p>Phone: + 91 9150150687</p>
            <p><a href="https://dealslah.com/" target="_blank">https://dealslah.com/</a></p>
            <p>Powered by Dealslah</p>
        </div>
    </div>
</body>

</html>
