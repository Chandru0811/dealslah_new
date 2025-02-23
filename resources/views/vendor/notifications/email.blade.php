<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dealslah | Reset Password</title>
  </head>
  <body style="background-color: #f7f9fc; font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0;">
    <div style="max-width: 650px; background-color: #ffffff; margin: 40px auto; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border-top: 5px solid #ef4444; border-bottom: 3px solid #888888;">
      <!-- Header -->
      <div style="padding: 25px; border-bottom: 1px solid #ddd; text-align: center;">
        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
          <tr>
            <td align="left" style="vertical-align: middle;">
              <img src="https://dealslah.com/assets/images/home/email_logo.png" alt="Deals Machi" style="max-width: 150px; height: auto;" />
            </td>
            <td align="right" style="vertical-align: middle; font-size: 14px; color: #333;">
              <a href="https://dealslah.com/" target="_blank" style="text-decoration: none; color: #333; font-size: 12px; font-weight: 400;">Your <span style="color: #ef4444;">dealslah.com</span></a> |
              <a href="tel:919150150687" target="_blank" style="text-decoration: none; color: #333; font-size: 12px; font-weight: 400;">+65 88941306</a> |
              <a href="https://play.google.com/store/apps/details?id=com.dealslah.dealslah" target="_blank" style="text-decoration: none; color: #333; font-size: 12px; font-weight: 400;">Get <span style="color: #ef4444;">Dealslah</span> App</a>
            </td>
          </tr>
        </table>
      </div>

      <!-- Content -->
      <div style="padding: 10px 25px;">
        <p style="font-size: 24px; font-weight: 750;">Hello,</p>
        <p style="font-size: 14px;">You are receiving this email because we received a password reset request for your account.</p>
        <div style="text-align: center; margin: 30px 0;">
          <a href="{{$actionUrl}}" style="text-decoration: none;">
            <button style="background-color: #ef4444; color: #fff; border: none; padding: 12px 24px; font-size: 16px; border-radius: 4px; cursor: pointer; transition: background 0.3s ease;">Reset Password</button>
          </a>
        </div>
        <p style="font-size: 14px;">If you did not request a password reset, no further action is required.</p>
        <p style="margin-bottom: 0px;font-size: 14px;">Regards,</p>
        <p style="font-size: 14px;">Dealslah</p>
        <p style="border-bottom: 1px solid #c2c2c2;"></p>
        <p style="font-size: 14px;">If you are having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
          <a href="{{$displayableActionUrl}}">{{$actionUrl}}</a>
        </p>
      </div>

      <!-- Footer -->
      <div style="padding: 15px 25px; text-align: center;">
        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
          <tr>
            <td align="left" style="vertical-align: middle;">
              <img src="https://dealslah.com/assets/images/home/email_logo.png" alt="dealslah" style="max-width: 150px; height: auto; margin-bottom: 10px;" />
            </td>
            <td align="right" style="vertical-align: middle; font-size: 12px; color: #333;">
              Connect with <a href="https://dealslah.com/" target="_blank" style="color: #ef4444; text-decoration: none;">Dealslah</a> India
            </td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>
