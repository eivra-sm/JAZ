<?php include 'config.php'; ?>


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


  .checkout-container {
    max-width: 800px;
    margin: 100px auto;
    padding: 40px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  }
  .checkout-container h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 32px;
    font-weight: bold;
  }
  .form-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
  }
  .form-group {
    flex: 1;
    margin-bottom: 20px;
  }
  .form-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
  }
  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    background: rgba(255, 255, 255, 0.7);
  }
  .submit-btn {
    width: 100%;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    background-color: #d4a373;
    color: white;
    border: none;
    border-radius: 12px;
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
<div class="checkout-container">
  <h2>Fill up Form</h2>
  <form action="submit_order.php" method="POST">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required>
    </div>

    <div class="form-group">
      <label for="landmark">Landmark:</label>
      <input type="text" id="landmark" name="landmark">
    </div>

    <div class="form-group">
      <label for="contact">Contact #:</label>
      <input type="text" id="contact" name="contact" required>
    </div>

    <div class="form-group">
      <label for="order">Order:</label>
      <input type="text" id="order" name="order" required>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="payment">Mode of Payment:</label>
        <input type="text" id="payment" name="payment" value="Cash on Delivery" readonly>
      </div>
      <div class="form-group">
        <label for="downpayment">Down Payment:</label>
        <input type="text" id="downpayment" name="downpayment" value="COD" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="note">Note:</label>
        <input type="text" id="note" name="note">
      </div>
      <div class="form-group">
        <label for="receiver_id">ID of receiver (Upload Image):</label>
        <input type="file" id="receiver_id" name="receiver_id" accept="image/*" required>
      </div>
    </div>

    <button type="submit" class="submit-btn">Place Order</button>
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
