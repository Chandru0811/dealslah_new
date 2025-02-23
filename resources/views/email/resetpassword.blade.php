<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap Css  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

  <title>Dealslah | Reset Password</title>
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

    /* .content a {
        color: #1827d2;
      } */

    .content p {
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

    .footer p {
      font-size: 12px;
    }

    .reset_btn {
      background-color: #ef4444;
      border-color: #ef4444;
    }

    .reset_btn:hover {
      background-color: #dd1a65;
      border-color: #d31c63;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header -->
    <div class="header" style="padding: 25px; border-bottom: 1px solid #ddd; text-align: center">
      <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
        <tr>
          <td align="left" style="vertical-align: middle">
            <img src="https://dealslah.com/assets/images/home/email_logo.png" alt="Deals Machi"
              style="max-width: 150px; height: auto" />
          </td>
          <td align="right" style="vertical-align: middle">
            <div class="headerText" style="font-size: 14px; color: #333">
              <a href="https://dealslah.com/" target="_blank" style="text-decoration: none; color: #333">
                Your <span style="color: #ef4444">dealslah.com</span>
              </a>
              |
              <a href="tel:6588941306" target="_blank" style="text-decoration: none; color: #333">
                +65 88941306
              </a>
              |
              <a href="https://play.google.com/store/apps/details?id=com.dealslah.dealslah" target="_blank"
                style="text-decoration: none; color: #333">
                Get <span style="color: #ef4444">Dealslah</span> App
              </a>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- Content -->
    <div class="content">
      <p style="font-size: 24px; font-weight: 750;">
        Hello,
      </p>
      <p class="mt-2">
        You are receiving this email because we received a password reset
        request for your account.
      </p>
      <div class="text-center my-4">
        <a href="./reset"><button class="btn btn-primary btn-sm reset_btn" type="button">
            Reset Password
          </button></a>
      </div>
      <p>
        This password reset link expire in 60 minutes.
      </p>
      <p>
        If your did not request a password reset, no further action is
        required.
      </p>
      <p style="margin-bottom: 0px !important">
        Regards,
      </p>
      <p>Laravel</p>
      <p style="border-bottom: 1px solid #c2c2c2;"></p>
      <p class="mt-3">
        If your are having trouble clicking the "Reset Password" button, copy
        and paste the URL below into your web browser: <a href="./a">https://dealslah.com/reset-password/e1b2d
          ed4906c830196ea1c24521d7f55d69b4f101205bf6f7e1fdf7a520625eb?email=moh
          itsudhanecs%40gmail.com</a>
      </p>
    </div>

    <!-- Footer -->
    <div class="footer" style="padding: 15px 25px; text-align: center">
      <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
        <tr>
          <td align="left" style="vertical-align: middle">
            <img src="https://dealslah.com/assets/images/home/email_logo.png" alt="dealslah"
              style="max-width: 150px; height: auto; margin-bottom: 10px" />
          </td>
          <td align="right" style="vertical-align: middle">
            <p style="font-size: 12px; color: #333; margin: 0">
              Connect with
              <a href="https://dealslah.com/" target="_blank"
                style="color: #ef4444; text-decoration: none">Dealslah</a>
              India
            </p>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <!-- Bootstrap Js  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>