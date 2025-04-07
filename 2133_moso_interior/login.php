<?php
require("db.php"); // Database connection file

// Define the loginUser function
function loginUser($username, $password) {
    global $conn;

    // Prepare and execute the query securely
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check hashed password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return "Success";
        } else {
            return "Invalid password.";
        }
    } else {
        return "User not found.";
    }
}

// Initialize variables
$username = $password = "";
$response = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Call login function
    $response = loginUser($username, $password);

    // Redirect if login is successful
    if ($response === "Success") {
        header("Location: index.html");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
  <form action="" method="POST">
    <h2>Login</h2>

    <?php if (!empty($response) && $response !== "Success") { ?>
      <p class="error"><?php echo htmlspecialchars($response); ?></p>
    <?php } ?>

    <div class="input-field">
      <input type="text" name="username" required>
      <label>Enter your username</label>
    </div>

    <div class="input-field">
      <input type="password" name="password" id="pwd" required>
      <label>Enter your password</label>
    </div>

    <div class="forget">
      <label for="remember">
        <input type="checkbox" id="remember">
        <p>Remember me</p>
      </label>
      <a href="forgetpass.php">Forgot password?</a>
    </div>

    <button type="submit" name="submit">Log In</button>

    <div class="register">
      <p>Don't have an account? <a href="signup.php">Register</a></p>
    </div>
  </form>
</div>
</body>
</html>
