<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $name = trim($_POST['name']) ?: 'Anonymous';
    $review = trim($_POST['review']);

    if ($review) {
        // Save name in a guest table or just store review without linking to user
        $stmt = $conn->prepare("INSERT INTO reviews (product_id, review) VALUES (?, ?)");
        $stmt->bind_param("is", $product_id, $review);
        $stmt->execute();
    }
}

header("Location: product.php?id=" . $product_id);
exit;
