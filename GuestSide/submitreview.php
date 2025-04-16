<?php
session_start();
require 'db.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $review_text = trim($_POST['review_text']);
    $created_at = date('Y-m-d H:i:s');

    // Image upload
    $image_path = '';
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/reviews/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $filename = uniqid() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        }
    }

    $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, rating, review_text, image_path, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisss", $product_id, $user_id, $rating, $review_text, $image_path, $created_at);
    $stmt->execute();

    header("Location: product.php?id=" . $product_id);
    exit;
}
?>
