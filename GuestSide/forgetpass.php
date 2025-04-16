<?php
require "functions.php";
$response = "";
if (isset($_POST['submit'])) {
    $response = passwordReset($_POST['email']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('hero-bg.jpg') no-repeat center center/cover;
            font-family: Arial, sans-serif;
        }

        .reset-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .reset-container h2 {
            color: white;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #ff5722;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #e64a19;
        }

        .login-link {
            color: white;
            text-decoration: none;
            display: block;
            margin-top: 10px;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <form action="" method="post" autocomplete="off">
            <h2>Password Reset</h2>
            <h4>Please enter your email to receive a new password.</h4>
            
            <input class="input-field" type="email" name="email" placeholder="Enter your email" required>
            
            <button type="submit" name="submit">Reset Password</button>
            
            <?php if ($response): ?>
                <p class="<?php echo ($response === 'success') ? 'success' : 'error'; ?>">
                    <?php echo htmlspecialchars($response); ?>
                </p>
            <?php endif; ?>
            
            <p class="login-link"><a href="index.php" class="login-link">Back to Login</a></p>
        </form>
    </div>
</body>
</html>
