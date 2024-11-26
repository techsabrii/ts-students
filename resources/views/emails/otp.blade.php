<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        /* General styles for the email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            width: 100%;
            padding: 20px;
            text-align: center;
            background-color: #ffffff;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #4CAF50;
            margin: 20px 0;
        }

        .description {
            font-size: 16px;
            color: #555555;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 14px;
            color: #888888;
            margin-top: 30px;
        }

        /* Button styles */
        .cta-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        .cta-button:hover {
            background-color: #45a049;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .email-content {
                width: 100%;
                padding: 15px;
            }

            .header {
                font-size: 22px;
            }

            .otp-code {
                font-size: 30px;
            }

            .description {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-content">
            <!-- Email Header -->
            <div class="header">
                OTP Verification Code
            </div>

            <!-- OTP Code Display -->
            <div class="otp-code">
                {{ $otp }}
            </div>

            <!-- Description -->
            <div class="description">
                This is your one-time password (OTP) to verify your account. The OTP is valid for 20 minutes from the time it was sent.
            </div>

            <!-- Call to Action Button (optional, for redirecting to verification page) -->
            <a href="{{ route('otp.verify') }}" class="cta-button">Verify Your OTP</a>

            <!-- Footer -->
            <div class="footer">
                <p>If you did not request this OTP, please ignore this email.</p>
                <p>Thank you for using our service!</p>
            </div>
        </div>
    </div>
</body>
</html>
