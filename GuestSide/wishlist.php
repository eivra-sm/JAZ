<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch wishlist items
$stmt = $conn->prepare("
    SELECT p.id, p.name, p.image, p.price
    FROM wishlist w
    JOIN products p ON w.product_id = p.id
    WHERE w.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Count for navbar
$count_stmt = $conn->prepare("SELECT COUNT(*) FROM wishlist WHERE user_id = ?");
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_stmt->bind_result($wishlist_count);
$count_stmt->fetch();
$count_stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Wishlist</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f8f8f8;
      padding: 30px;
    }

    .wishlist-container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .wishlist-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 25px;
      border-bottom: 1px solid #eee;
      padding-bottom: 15px;
    }

    .wishlist-item img {
      width: 100px;
      height: auto;
      border-radius: 8px;
    }

    .wishlist-info {
      flex: 1;
      margin-left: 20px;
    }

    .wishlist-actions a {
      margin-right: 15px;
    }

    .btn-remove {
      color: red;
      text-decoration: none;
    }

    .btn-remove:hover {
      text-decoration: underline;
    }

    .navbar {
      margin-bottom: 40px;
    }
  </style>
</head>
<body>

<!-- Navbar with Wishlist Count -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">V&P <span class="text-danger">Furniture</span></a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php#section_1">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop-listing.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="wishlist.php">
            <i class="bi bi-heart-fill text-danger"></i> Wishlist (<?= $wishlist_count ?>)
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="myacc.php">My Account</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="wishlist-container">
  <h2 class="mb-4">My Wishlist</h2>

  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
  <?php endif; ?>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="wishlist-item">
        <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <div class="wishlist-info">
          <h5><?= htmlspecialchars($row['name']) ?></h5>
          <p>₱<?= number_format($row['price'], 2) ?></p>
        </div>
        <div class="wishlist-actions">
          <a href="product.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm">View</a>
          <a href="removewishlist.php?product_id=<?= $row['id'] ?>" class="btn-remove">Remove</a>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>You have no items in your wishlist yet.</p>
  <?php endif; ?>
</div>

</body>
</html>
