<?php
session_start();
include 'db.php';

$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    echo "No product ID provided!";
    exit;
}

// Fetch product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found!";
    exit;
}

// Handle add to wishlist
if (isset($_POST['wishlist'])) {
    $user_id = $_SESSION['user_id'] ?? 1; // Replace with actual session user ID

    $check = $pdo->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
    $check->execute([$user_id, $product_id]);

    if ($check->rowCount() == 0) {
        $insert = $pdo->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
        $insert->execute([$user_id, $product_id]);
    }
}

// Handle review submission
if (isset($_POST['review_submit'])) {
    $user_id = $_SESSION['user_id'] ?? 1; // Replace with real session
    $name = $_POST['name'] ?? 'Anonymous';
    $review = $_POST['review'] ?? '';

    if (!empty($review)) {
        $stmt = $pdo->prepare("INSERT INTO reviews (product_id, user_id, name, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([$product_id, $user_id, $name, $review]);
    }
}

// Fetch reviews
$review_stmt = $pdo->prepare("SELECT * FROM reviews WHERE product_id = ?");
$review_stmt->execute([$product_id]);
$reviews = $review_stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($product['name']) ?></title>
    <style>
        .main-image {
            width: 400px;
            height: auto;
        }
        .thumbnail {
            width: 80px;
            cursor: pointer;
            margin: 5px;
        }
        .review {
            margin-top: 20px;
        }
        .review p {
            margin: 5px 0;
        }
    </style>
    <script>
        function changeImage(img) {
            document.getElementById("mainImage").src = img.src;
        }
    </script>
</head>
<body>
    <h2><?= htmlspecialchars($product['name']) ?></h2>
    <p><strong>$<?= htmlspecialchars($product['price']) ?></strong></p>

    <img src="<?= $product['image'] ?>" id="mainImage" class="main-image" alt="Product Image"><br>
    <img src="<?= $product['image'] ?>" class="thumbnail" onclick="changeImage(this)">
    <img src="images/furniture1.jpg" class="thumbnail" onclick="changeImage(this)">
    <img src="images/furniture2.jpg" class="thumbnail" onclick="changeImage(this)">

    <p><strong>Description:</strong><br><?= htmlspecialchars($product['description']) ?></p>
    <p><strong>Available Color:</strong> <?= htmlspecialchars($product['color']) ?></p>
    <p><strong>Specification:</strong> <?= htmlspecialchars($product['specification']) ?></p>

    <form method="POST">
        <button type="submit" name="wishlist">♡ Add to Wishlist</button>
        <button type="submit" name="buy">BUY</button>
    </form>

    <div class="review">
        <h3>Customer Reviews</h3>
        <?php foreach ($reviews as $rev): ?>
            <p><strong><?= htmlspecialchars($rev['name']) ?></strong></p>
            <p><?= nl2br(htmlspecialchars($rev['content'])) ?></p>
        <?php endforeach; ?>
    </div>

    <form method="POST">
        <h4>Write a Review</h4>
        <input type="text" name="name" placeholder="Your Name"><br>
        <textarea name="review" rows="4" cols="50" placeholder="Your review..." required></textarea><br>
        <button type="submit" name="review_submit">Submit Review</button>
    </form>
</body>
</html>
