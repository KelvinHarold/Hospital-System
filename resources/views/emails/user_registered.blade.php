<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            color: black
            text-align: center;
            padding: 20px 15px;
        }
        .email-header img {
            max-width: 80px;
            margin-bottom: 10px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .email-body {
            padding: 25px;
            color: #333333;
        }
        .email-body h2 {
            color: #4CAF50;
            margin-top: 0;
        }
        .footer {
            background-color: #f1f1f1;
            color: #777777;
            text-align: center;
            padding: 15px;
            font-size: 12px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <!-- Logo and Title -->
            <img src="{{ url('images/Logo.jpg') }}" alt="MtotoClinic Logo">
            <h1>MtotoClinic</h1>
        </div>

        <div class="email-body">
            <h2>Welcome, {{ $name }}!</h2>
            <p>Your account has been successfully created.</p>

            <p><strong>Phone Number:</strong> {{ $phone }}</p>
            <p><strong>Password:</strong> {{ $Password }}</p>

            <p>Please log in to your account and consider changing your password for security purposes.</p>

            <p>Thank you for joining MtotoClinic. If you have any questions or need support, feel free to contact us.</p>
        </div>

        <div class="footer">
            <p>Contact us: <a href="mailto:support@mtotoclinic.com">support@mtotoclinic.com</a></p>
            <p>&copy; 2025 MtotoClinic. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
