<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f7f7f7;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
        }
        .btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Password Reset OTP</h2>
    <p>We received a request to reset your password. Use the following OTP to complete the process:</p>

    <h3 style="color: #007bff; text-align: center;">{{ $otp }}</h3>

    // In the view (Blade template)
    <p>This OTP will expire on: <strong>{{ $expiresAt->format(' h:i:s A d-M-Y') }}</strong></p>



    <p>If you did not request a password reset, please ignore this email or contact support.</p>

    <p>Thank you!</p>

    <div class="footer">
        <p>&copy; {{ date('Y') }} techsabrii.com. All rights reserved.</p>
    </div>
</div>

</body>
</html>
