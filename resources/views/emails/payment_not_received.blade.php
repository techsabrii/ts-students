<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Not Received</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS (optional) -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .content h3 {
            color: #f44336; /* Red for the warning */
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <h2 style="color: #333;">Payment Not Received</h2>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>Dear <strong>{{ $userName }}</strong>,</p>
            <p>We have not yet received your Fee for the course: <strong>{{ $courseName }}</strong>, Month: <strong>{{ $month }}</strong>.</p>
            <h3>Please make the payment as soon as possible to avoid any interruptions in your course access.</h3>
            <p>We understand that sometimes payments can be delayed, so please ensure to complete the payment promptly to continue benefiting from the course.</p>

            <p>If you have any issues with the payment process, feel free to contact us at any time.</p>
            <p>For assistance, please contact us at <a href="wa.me/923075630721">Whatsapp</a>.</p>
            <p>Thank you for your attention to this matter.</p>

            <p>Best regards,<br><strong>TS-Developers</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>For assistance, please contact us at <a href="mailto:support@techsabrii.com">support@techsabrii.com</a>.</p>
            <p>&copy; {{ date('Y') }} Your techsabrii.com. All Rights Reserved.</p>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional for interactivity) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
