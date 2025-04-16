<?php
include 'db_connection.php';

$error = "";
$success = "";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM customers_info WHERE ID = $id AND User_lvl = 3");
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "No ID provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['Fullname']);
    $email = $conn->real_escape_string($_POST['Email']);
    $birthday = $_POST['Birthday'];
    $billing_address = $conn->real_escape_string($_POST['Billing_Address']);
    
    $profile_photo = $admin['Profile_Photo']; 

    if (isset($_FILES['Profile_Photo']) && $_FILES['Profile_Photo']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Profile_Photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["Profile_Photo"]["tmp_name"]);
        if ($check === false) {
            $error = "File is not an image.";
        } else {
            $allowed_types = ['jpg', 'jpeg', 'png'];
            if (!in_array($imageFileType, $allowed_types)) {
                $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            } else {
                if (move_uploaded_file($_FILES["Profile_Photo"]["tmp_name"], $target_file)) {
                    $profile_photo = $target_file;
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

    $check_email = $conn->query("SELECT * FROM customers_info WHERE Email = '$email' AND ID != $id");

    if ($check_email->num_rows > 0) {
        $error = "The email is already in use by another account.";
    } else {
        $update = "UPDATE customers_info SET 
            Fullname = '$fullname',
            Email = '$email',
            Birthday = '$birthday',
            Billing_Address = '$billing_address',
            Profile_Photo = '$profile_photo'
            WHERE ID = $id AND User_lvl = 3";

        if ($conn->query($update)) {
            $success = "Profile updated successfully!";
            header("Location: accountsLi.php");
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn {
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .alert {
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
        }

        .form-buttons .btn {
            width: 48%;
        }

        input[type="file"] {
            padding: 5px; 
            font-size: 14px; 
            width: auto;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Edit Admin</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif (!empty($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
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
        <div class="form-group">
            <label>Profile Picture</label>
            <input type="file" name="Profile_Photo" class="form-control">
            <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF</small>
        </div>
        
        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="dashboardSuperad.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
