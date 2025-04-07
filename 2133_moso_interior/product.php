<?php
include 'db.php'; // assumes this has session_start()
if (!isset($_GET['id'])) {
    echo "Product not found.";
    exit;
}

$product_id = intval($_GET['id']);

// Get product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
if (!$product) {
    echo "Product not found.";
    exit;
}

// Get reviews
$reviews_stmt = $conn->prepare("SELECT r.review, u.name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = ?");
$reviews_stmt->bind_param("i", $product_id);
$reviews_stmt->execute();
$reviews_result = $reviews_stmt->get_result();

// Wishlist check
$in_wishlist = false;
if (isset($_SESSION['user_id'])) {
    $wish_stmt = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
    $wish_stmt->bind_param("ii", $_SESSION['user_id'], $product_id);
    $wish_stmt->execute();
    $wish_result = $wish_stmt->get_result();
    $in_wishlist = $wish_result->num_rows > 0;
}
?>


<!DOCTYPE html>

<html lang="en">
    <style>
        <html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(4px);
        }
        .container {
            max-width: 1100px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 1px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            display: flex;
            gap: 100px;
        }
        .left-side {
            flex: 1;
        }
        .main-image {
            width: 100%;
            border-radius: 20px;
        }
        .thumbnails {
            display: flex;
            gap: 100px;
            margin-top: 15px;
            justify-content: center;
        }
        .thumbnails img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .right-side {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-side h1 {
            margin: 0;
            font-size: 28px;
        }
        .right-side p {
            margin: 8px 0;
            font-size: 16px;
        }
        .buy-button {
            margin-top: 20px;
            padding: 12px 0;
            background-color: #a57c5b;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .wishlist-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: <?= $in_wishlist ? 'red' : '#333' ?>;
        }
        .reviews {
            max-width: 1100px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            padding: 20px;
            backdrop-filter: blur(10px);
        }
        .review {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        .review .avatar {
            width: 40px;
            height: 40px;
            background-color: #ddd;
            border-radius: 50%;
        }
        .review .text {
            flex: 1;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .arrows {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            font-size: 20px;
        }
        .arrows span {
            margin: 0 10px;
            cursor: pointer;
        }
    </style>
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="Tooplate" name="author"/>
<title> PRODUCT</title>
<!-- CSS FILES -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link href="css/bootstrap-icons.css" rel="stylesheet"/>

        <link href="css/owl.carousel.min.css" rel="stylesheet"/>
<link href="css/tooplate-moso-interior.css" rel="stylesheet"/>
<!--

Tooplate 2133 Moso Interior

https://www.tooplate.com/view/2133-moso-interior

Bootstrap 5 HTML CSS Template

-->
</head>
<body class="shop-listing-page">
<nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
<div class="container">
<a class="navbar-brand" href="index.html">PR<span class="tooplate-red">ODU</span><span class="tooplate-green">CT</span></a>
<button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarNav" data-bs-toggle="collapse" type="button">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link click-scroll" href="index.html#section_1">Home</a>
</li>
<li class="nav-item">
<a class="nav-link click-scroll" href="index.html#section_2">About</a>
</li>
<li class="nav-item dropdown">
<a aria-expanded="false" class="nav-link dropdown-toggle click-scroll" data-bs-toggle="dropdown" href="index.html#section_3" id="navbarLightDropdownMenuLink" role="button">Shop</a>
<ul aria-labelledby="navbarLightDropdownMenuLink" class="dropdown-menu dropdown-menu-light">
<li><a class="dropdown-item active" href="shop-listing.html">Shop Listing</a></li>
</ul>
</li>
<li class="nav-item">
<a class="nav-link click-scroll" href="#section_4">Contact Us</a>
</li>
<li class="nav-item">
<a class="nav-link click-scroll" href="#section_5">FAQs</a>
</li>
<li class="nav-item">
<a class="nav-link click-scroll" href="#section_5">My Account</a>
</li>
</ul>
</div>
</div>
</nav>
<br><br><br>
<main>
<div class="container">
    <!-- Left: Image + thumbnails -->
    <div class="left-side">
        <img class="main-image" src="images/sharing-design-ideas-with-family.jpg<?= htmlspecialchars($product['images/sharing-design-ideas-with-family.jpg']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <div class="thumbnails">
            <img src="images/sharing-design-ideas-with-family.jpg<?= htmlspecialchars($product['image']) ?>" alt="">
            <img src="images/sharing-design-ideas-with-family.jpg<?= htmlspecialchars($product['image']) ?>" alt="">
            <img src="images/sharing-design-ideas-with-family.jpg<?= htmlspecialchars($product['image']) ?>" alt="">
        </div>
        <div class="arrows">
            <span>&lt;</span>
            <span>&gt;</span>
        </div>
    </div>

    <!-- Right: Product Info -->
    <div class="right-side">
        <h1><?= htmlspecialchars($product['name']) ?></h1>
        <p><strong>Price:</strong> ₱<?= number_format($product['price'], 2) ?></p>
        <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($product['description'])) ?></p>
        <p><strong>Available Color:</strong> <?= htmlspecialchars($product['color']) ?></p>
        <p><strong>Specification:</strong> <?= htmlspecialchars($product['specification']) ?></p>

       <button class="buy-button"> <a href="form.php">BUY</a></button>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="post" action="toggle_wishlist.php" style="margin-top: 10px;">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" class="wishlist-btn">
                    <?= $in_wishlist ? "♥ Remove from Wishlist" : "♡ Add to Wishlist" ?>
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>

<<!-- Review Section -->
<div class="reviews">
    <h2>Customer Reviews</h2>

    <?php while ($review = $reviews_result->fetch_assoc()): ?>
        <div class="review">
            <div class="avatar"></div>
            <div class="text"><strong><?= htmlspecialchars($review['name'] ?? 'Anonymous') ?>:</strong> <?= htmlspecialchars($review['review']) ?></div>
        </div>
    <?php endwhile; ?>

    <h3>Write a Review</h3>
    <form action="submitreview.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="text" name="name" placeholder="Your name (optional)" style="width: 100%; padding: 10px; margin-bottom: 10px;">
        <textarea name="review" rows="4" style="width: 100%; padding: 10px;" required placeholder="Share your thoughts..."></textarea>
        <button type="submit" class="buy-button" style="margin-top: 10px;">Submit Review</button>
    </form>
</div>
</footer>
<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/click-scroll.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
