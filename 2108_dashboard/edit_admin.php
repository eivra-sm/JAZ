<?php
include 'db_connection.php';

$error = "";

// Fetch current data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM customers_info WHERE ID = $id AND User_lvl = 2");
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
    } else {
        echo "Admin not found.";
        exit();
    }
} else {
    echo "No ID provided.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['Fullname']);
    $email = $conn->real_escape_string($_POST['Email']);
    $birthday = $_POST['Birthday'];
    $billing_address = $conn->real_escape_string($_POST['Billing_Address']);

    // Check if email is already used by another user
    $check_email = $conn->query("SELECT * FROM customers_info WHERE Email = '$email' AND ID != $id");
    if ($check_email->num_rows > 0) {
        $error = "Email is already in use by another account.";
    } else {
        // Update the admin
        $update = "UPDATE customers_info SET 
            Fullname = '$fullname',
            Email = '$email',
            Birthday = '$birthday',
            Billing_Address = '$billing_address'
            WHERE ID = $id AND User_lvl = 2";

        if ($conn->query($update)) {
            header("Location: admin_list.php");
            exit();
        } else {
            $error = "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Admin</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Fullname</label>
            <input type="text" name="Fullname" class="form-control" value="<?= htmlspecialchars($admin['Fullname']) ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="Email" class="form-control" value="<?= htmlspecialchars($admin['Email']) ?>" required>
        </div>
        <div class="form-group">
            <label>Birthday</label>
            <input type="date" name="Birthday" class="form-control" value="<?= $admin['Birthday'] ?>">
        </div>
        <div class="form-group">
            <label>Billing Address</label>
            <input type="text" name="Billing_Address" class="form-control" value="<?= htmlspecialchars($admin['Billing_Address']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="admin_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
