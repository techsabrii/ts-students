<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Received</title>
    <!-- Bootstrap CDN for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h2 {
            color: #2c3e50;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 15px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-container">
            <div class="header">
                <h2>Payment Received</h2>
            </div>

            <div class="content">
                <p>Dear <strong>{{ $userName }}</strong>,</p>
                <p>We have successfully received your Fee for the course: <strong>{{ $courseName }}, Month: {{ $month}}</strong>.</p>
                <p>Thank you for your payment! You are now fully enrolled in the course again.</p>
                <p>If you have any questions or need further assistance, feel free to reach out to us.</p>

                <p>Best regards,<br>
                <strong>Your Course Team</strong></p>

                <a href="https://students.techsabrii.com" class="btn-primary">Visit Your Portal</a>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} techsabrii.com. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
