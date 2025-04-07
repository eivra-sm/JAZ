<?php
require "db.php"; // Ensure this file contains correct database credentials

function connect() {
    $conn = new mysqli("localhost", "root", "", "rogelindiv");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// ✅ FIXED: registerUser function now correctly handles 4 parameters
function registerUser($email, $username, $password, $confirm_password) {
    $mysqli = connect();
    
    if (!$mysqli) {
        return "Database connection error.";
    }

    // Trim input values
    $email = trim($email);
    $username = trim($username);
    $password = trim($password);
    $confirm_password = trim($confirm_password);

    // Validate required fields
    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        return "All fields are required.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        return "Passwords do not match.";
    }

    // Check if email already exists
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->fetch_assoc()) {
        return "Email already exists.";
    }

    // Check if username already exists
    $stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->fetch_assoc()) {
        return "Username already exists.";
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $mysqli->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $email);
    
    if ($stmt->execute()) {
        return "success";
    } else {
        return "Registration failed. Please try again.";
    }
}

// ✅ FIXED: loginUser function now correctly starts a session and validates user login
function loginUser($username, $password) {
    session_start();
    $mysqli = connect();

    if (!$mysqli) {
        return "Database connection error.";
    }

    // Trim and sanitize input
    $username = trim($username);
    $password = trim($password);

    if (empty($username) || empty($password)) {
        return "Both fields are required.";
    }

    // Check user credentials
    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        return "Wrong username or password.";
    }

    if (!password_verify($password, $data["password"])) {
        return "Wrong username or password.";
    }

    // Set session and redirect
    $_SESSION["user"] = $username;
    header("location: account.php");
    exit();
}

// ✅ FIXED: logoutUser function now correctly destroys session
function logoutUser() {
    session_start();
    session_destroy();
    header("location: login.php");
    exit();
}

// ✅ FIXED: passwordReset function now generates and emails a new password
function passwordReset($email) {
    $mysqli = connect();

    if (!$mysqli) {
        return "Database connection error.";
    }

    $email = trim($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }

    // Check if email exists
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        return "Email does not exist in the database.";
    }

    // Generate a new random password
    $new_pass = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 12);
    $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

    // Send email
    $subject = "Password Reset Request";
    $body = "Your new password is: <strong>{$new_pass}</strong>. Please log in and change it immediately.";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: Admin <no-reply@example.com>\r\n";

    if (!mail($email, $subject, $body, $headers)) {
        return "Failed to send reset email. Please try again.";
    }

    // Update password in database
    $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
        return "There was a problem resetting your password.";
    }

    return "success";
}

// ✅ FIXED: deleteAccount function now properly deletes a user account
function deleteAccount() {
    session_start();
    $mysqli = connect();

    if (!$mysqli) {
        return "Database connection error.";
    }

    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $_SESSION['user']);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
        return "An error occurred. Please try again.";
    } else {
        session_destroy();
        header("location: deletemess.php");
        exit();
    }
}
?>
