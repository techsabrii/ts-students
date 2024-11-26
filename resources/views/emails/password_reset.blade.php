<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333;
            font-size: 24px;
        }
        .content {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
        .content p {
            margin-bottom: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <h1>Password Reset Confirmation</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>Hello,</p>
            <p>Your password has been successfully reset. Here are your new login details:</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
            <p>Please keep this information secure and consider changing your password if needed for additional security.</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>If you have any questions, please feel free to contact us at <a href="mailto:support@techsabrii.com">support@techsabrii.com</a>.</p>
            <p>&copy; {{ date('Y') }} techsabrii.com. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
