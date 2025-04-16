<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Student Pro Education</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #55b4a0;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #55b4a0;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #469786;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Student Pro Education!</h1>
        <p>Hi {{ $user->name }},</p>
        <p>You have been successfully registered at <strong>Student Pro Education</strong> as <strong>{{ $user->roles[0]->name }}</strong>.</p>
        <p>Here are your login credentials:</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Password:</strong> {{ $newPassword }}</p>
        <p>To get started, click the button below to log in:</p>
        <a href="{{ $loginUrl }}" class="button">Log In</a>
        <p class="footer">If you have any questions, feel free to reach out to our support team.</p>
    </div>
</body>
</html>
