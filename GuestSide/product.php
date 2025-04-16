<?php
session_start();
include 'db.php'; // your DB connection file

// Ensure a product id is provided.
if (!isset($_GET['id'])) {
    echo "Product not found.";
    exit;
}
$product_id = intval($_GET['id']);

// ----------
// FETCH PRODUCT
// ----------
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $product_id);
$stmt->execute();
$productResult = $stmt->get_result();
$product = $productResult->fetch_assoc();
$stmt->close();

if (!$product) {
    echo "Product not found.";
    exit;
}

// ----------
// HANDLE REVIEW SUBMISSION
// ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $rating = intval($_POST['rating']);
    $review_text = trim($_POST['review_text']);
    $image_path = "";

    // Process the uploaded image if provided
    if (!empty($_FILES['review_image']['name'])) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $filename = time() . '_' . basename($_FILES['review_image']['name']);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['review_image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        }
    }

    $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, rating, review_text, image_path, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("iiiss", $product_id, $user_id, $rating, $review_text, $image_path);
    $stmt->execute();
    $stmt->close();

    header("Location: product.php?id=" . $product_id);
    exit;
}

// ----------
// FETCH REVIEWS
// ----------
$stmt = $conn->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $product_id);
$stmt->execute();
$reviewsResult = $stmt->get_result();
$reviews = $reviewsResult->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?> - Product Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- or your own CSS -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg,rgb(252, 252, 252), #3a3a3a);
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 40px;
            max-width: 1000px;
            margin: auto;
        }
        /* Product Details Glass Card */
        .product-details {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 30px;
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }
        .product-details img {
            width: 300px;
            border-radius: 16px;
        }
        /* Review Form & Card Glassmorphism */
        .review-form, .review-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
            margin-bottom: 20px;
            color: #fff;
        }
        .review-form textarea,
        .review-form select,
        .review-form input[type="file"] {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        .review-form button {
            background: rgba(255, 255, 255, 0.25);
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            color: #fff;
            cursor: pointer;
        }
        .review-form button:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        .review-card img {
            margin-top: 10px;
            max-width: 100%;
            border-radius: 12px;
        }
        .review-card strong {
            font-size: 1.1em;
        }
        .review-card small {
            color: #ccc;
            font-size: 0.8em;
        }
        .star {
            color: gold;
            font-size: 1.1em;
        }
        .wishlist-btn {
            margin-top: 10px;
            display: inline-block;
            background: #ff5e5e;
            padding: 10px 20px;
            border-radius: 12px;
            color: #fff;
            text-decoration: none;
        }
        .wishlist-btn:hover {
            background: #ff7777;
        }

        .back-button {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(8px);
    color: #fff;
    text-decoration: none;
    border-radius: 12px;
    font-weight: bold;
    transition: 0.3s;
}
.back-button:hover {
    background: rgba(255, 255, 255, 0.35);
}

.custom-navbar {
  background-color: #246575 !important;
}


            .custom-navbar {
  background-color: #246575 !important;
}


.custom-navbar .nav-link,
.custom-navbar .navbar-brand,
.custom-navbar .navbar-toggler-icon {
  color: white !important;
}

.custom-navbar .nav-link:hover {
  color: #ecba81 !important; /* soft orange on hover, optional */
}

/* Optional: Style the toggler button icon */
.custom-navbar .navbar-toggler {
  border-color: white !important;
}
.custom-navbar .navbar-toggler-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

        

    </style>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Tooplate">

    <title>V&P Furniture</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/tooplate-moso-interior.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!--

Tooplate 2133 Moso Interior

https://www.tooplate.com/view/2133-moso-interior

Bootstrap 5 HTML CSS Template

-->

</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top shadow-lg custom-navbar">

            <div class="container">
                <p style=" color: white; font-family: 'Times New Roman', Times, serif;"><a class="navbar-brand" href="index.php">V&P Furniture </p></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_2">About</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle click-scroll" href="index.php#section_3" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="shop-listing.php">Shop Listing</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_4">Contact Us</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="faqs.php">FAQs</a>
                        </li>

                        <li class="nav-item text-center">
                            <a class="nav-link click-scroll" href="myacc.php" style="color: black;">
                                <i class="fas fa-user"></i>

                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>


<br><BR><BR>
<div class="container">

    <a href="shop-listing.php" class="back-button"><p style="color: black;">← Back to Shop</p></a>


    <!-- Product Details -->
    <div class="product-details">
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <div>
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p style=" color: black"><strong>Price:</strong> $<?= number_format($product['price'], 2) ?></p>
            <p style=" color: black;"><strong>Description:</strong> <?= htmlspecialchars($product['description']) ?></p>
            <p style=" color: black;"><strong>Color:</strong> <?= htmlspecialchars($product['color']) ?></p>
            <p style=" color: black;"><strong>Specification:</strong> <?= htmlspecialchars($product['specification']) ?></p>

            <?php if (isset($_SESSION['user_id'])): ?>
               <p style=" color: white;"> <a class="wishlist-btn" href="add_to_wishlist.php?product_id=<?= $product['id'] ?>">♡ Add to Wishlist</p></a>
            <?php else: ?>
                <p><a href="login.php" style="color: lightblue;">Log in</a> to add to wishlist.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Review Submission Form -->
    <h3>Write a Review</h3>
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="review-form">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="rating">Rating (1 to 5):</label>
            <select name="rating" id="rating" required>
                <option value="">-- Select --</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> ★</option>
                <?php endfor; ?>
            </select>

            <label for="review_text">Review:</label>
            <textarea name="review_text" id="review_text" rows="4" required></textarea>

            <label for="review_image">Attach a photo (optional):</label>
            <input type="file" name="review_image" id="review_image" accept="image/*">

            <button type="submit" name="submit_review">Submit Review</button>
        </form>
    </div>
    <?php else: ?>
        <p><a href="login.php" style="color: lightblue;">Log in</a> to write a review.</p>
    <?php endif; ?>

    <!-- Display Reviews -->
    <h3>User Reviews</h3>
    <?php if ($reviews): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review-card">
                <div>
                    <?php
                    // Display star rating
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $review['rating'] ? '<span class="star">★</span>' : '<span class="star" style="color:#bbb;">☆</span>';
                    }
                    ?>
                </div>
                <p><?= nl2br(htmlspecialchars($review['review_text'])) ?></p>
                <?php if ($review['image_path']): ?>
                    <img src="<?= htmlspecialchars($review['image_path']) ?>" alt="Review Image">
                <?php endif; ?>
                <small>Posted on <?= date("F j, Y, g:i a", strtotime($review['created_at'])) ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No reviews yet.</p>
    <?php endif; ?>
</div>
</body>
</html>
