<?php
include 'db.php';
if (!isset($_SESSION['user_id']) || !isset($_POST['product_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);

// Check if already in wishlist
$stmt = $conn->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?")->bind_param("ii", $user_id, $product_id)->execute();
} else {
    $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)")->bind_param("ii", $user_id, $product_id)->execute();
}

header("Location: product.php?id=" . $product_id);
exit;
