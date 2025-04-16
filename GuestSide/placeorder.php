<?php
include 'db.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = $_POST['name'];
    $address    = $_POST['address'];
    $landmark   = $_POST['landmark'];
    $contact    = $_POST['contact'];
    $order      = $_POST['order'];
    $payment    = $_POST['payment'];
    $downpayment= $_POST['downpayment'];
    $note       = $_POST['note'];

    // Handle file upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["receiver_id"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["receiver_id"]["tmp_name"], $targetFilePath)) {
            // Insert order into database (example)
            $stmt = $conn->prepare("INSERT INTO orders (name, address, landmark, contact, product_order, payment_mode, downpayment, note, receiver_id_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $name, $address, $landmark, $contact, $order, $payment, $downpayment, $note, $targetFilePath);
            $stmt->execute();
            $stmt->close();

            echo "<script>alert('Order placed successfully!'); window.location.href='thankyou.php';</script>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
?>
