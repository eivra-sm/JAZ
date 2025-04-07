<?php
session_start();
require("db.php");

$response = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
        $response = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $response = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $response = "Email or username already in use.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $username, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $response = "Error registering user.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('2.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .signup-box {
      background: rgba(255, 255, 255, 0.05);
      padding: 40px;
      border-radius: 15px;
      backdrop-filter: blur(12px);
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      max-width: 400px;
      width: 100%;
      color: white;
    }

    .signup-box h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .input-group {
      margin-bottom: 15px;
    }

    .input-group input {
      width: 100%;
      padding: 12px;
      background: transparent;
      border: none;
      border-bottom: 1px solid #ccc;
      color: white;
      font-size: 14px;
    }

    .input-group input::placeholder {
      color: #ccc;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background-color: white;
      color: black;
      border: none;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background-color: #ddd;
    }

    .bottom-text {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .bottom-text a {
      color: #fff;
      text-decoration: underline;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="signup-box">
    <h2>Sign Up</h2>

    <?php if (!empty($response)) : ?>
      <p class="error"><?php echo htmlspecialchars($response); ?></p>
    <?php endif; ?>

    <form method="POST">
      <div class="input-group">
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="input-group">
        <input type="text" name="username" placeholder="Choose a username" required>
      </div>
      <div class="input-group">
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>
      <div class="input-group">
        <input type="password" name="confirm_password" placeholder="Confirm your password" required>
      </div>

      <button type="submit" name="submit" class="submit-btn">Sign Up</button>
    </form>

    <div class="bottom-text">
      Already have an account? <a href="login.php">Log In</a>
    </div>
  </div>
</body>
</html>
