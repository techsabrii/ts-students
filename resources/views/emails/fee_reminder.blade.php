<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Reminder</title>
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
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
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
            <h1>Fee Reminder</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>Dear <strong>{{ $userName }}</strong>,</p>
            <p>We noticed that your fee for the course <strong>{{ $courseName }}</strong> for the month of <strong>{{ $month }}</strong> has not been submitted yet.</p>
            <p>Please kindly pay your fee to continue your learning and regain access to the course videos.</p>
            <p>If you have already paid, please ignore this message. Otherwise, please make the payment as soon as possible to avoid any interruptions in your access.</p>
            <a href="payment-link-here" class="button">Pay Now</a>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>If you have any questions, please feel free to contact us at <a href="mailto:support@techsabrii.com">support@techsabrii.com</a>.</p>
            <p>&copy; {{ date('Y') }} techsabrii.com . All rights reserved.</p>
        </div>
    </div>
</body>
</html>
