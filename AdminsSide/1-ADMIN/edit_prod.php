<?php
include 'db_connection.php';

$error = "";
$success = "";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM product_lists WHERE Product_ID = $id");
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "No ID provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prodname = $conn->real_escape_string($_POST['Product_Name']);
    $descrip = $conn->real_escape_string($_POST['Description']);
    $price = $conn->real_escape_string($_POST['Price']);
    $stock = $conn->real_escape_string($_POST['Stock']);
    $category = $conn->real_escape_string($_POST['Category']);

    $images = $admin['Images']; // Use existing image by default

    if (isset($_FILES['Images']) && $_FILES['Images']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Images"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["Images"]["tmp_name"]);
        if ($check === false) {
            $error = "File is not an image.";
        } else {
            $allowed_types = ['jpg', 'jpeg', 'png'];
            if (!in_array($imageFileType, $allowed_types)) {
                $error = "Only JPG, JPEG, and PNG files are allowed.";
            } else {
                if (move_uploaded_file($_FILES["Images"]["tmp_name"], $target_file)) {
                    $images = $target_file;
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

    if (empty($error)) {
        $check_name = $conn->query("SELECT * FROM product_lists WHERE Product_Name = '$prodname' AND Product_ID != $id");

        if ($check_name->num_rows > 0) {
            $error = "The product already exists.";
        } else {
            $update = "UPDATE product_lists SET 
                Product_Name = '$prodname',
                Descrip = '$descrip',
                Price = '$price',
                Stock = '$stock',
                Category = '$category',
                Images = '$images'
                WHERE Product_ID = $id";

            if ($conn->query($update)) {
                $success = "Product updated successfully!";
                header("Location: productsLi.php");
                exit();
            } else {
                $error = "Error updating record: " . $conn->error;
            }
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
            <label>Product Name</label>
            <input type="text" name="Product_Name" class="form-control" value="<?= htmlspecialchars($admin['Product_Name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="Description" class="form-control" value="<?= htmlspecialchars($admin['Descrip']) ?>" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" name="Price" class="form-control" value="<?= $admin['Price'] ?>">
        </div>
        <div class="form-group">
            <label>Stock</label>
            <input type="text" name="Stock" class="form-control" value="<?= htmlspecialchars($admin['Stock']) ?>">
        </div>
        <div class="form-group">
            <label>Images</label>
            <input type="file" name="Images" class="form-control">
            <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF</small>
        </div>
        <div class="form-group">
            <label>Category</label>
            <input type="text" name="Category" class="form-control" value="<?= htmlspecialchars($admin['Category']) ?>">
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="productsLi.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
