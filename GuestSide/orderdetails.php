<?php
session_start();
require("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_id = $_SESSION['user_id'];

// Fetch order details for this user
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Order not found or you don't have access.";
    exit();
}

$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Details</title>
  <link rel="stylesheet" href="style.css">
</head>
<style>

/* Reset and Base */
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(135deg, #e0eafc, #cfdef3);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Navigation Bar */
nav {
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(15px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.3);
  width: 100%;
  padding: 10px 0;
  position: sticky;
  top: 0;
  z-index: 1000;
}

nav ul {
  display: flex;
  justify-content: center;
  gap: 25px;
  list-style: none;
  margin: 0;
  padding: 0;
}

nav a {
  text-decoration: none;
  color: #000;
  font-weight: 600;
  transition: color 0.3s ease;
}

nav a:hover {
  color: #007bff;
}

/* Main Account Page Layout */
.account-wrapper {
  display: flex;
  gap: 30px;
  margin-top: 40px;
  flex-wrap: wrap;
  justify-content: center;
}

/* Glass Card */
.profile-card, .order-card, .order-details .left-box, .order-details .right-box {
  background: rgba(255, 255, 255, 0.25);
  border-radius: 20px;
  padding: 20px;
  backdrop-filter: blur(20px);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  color: #000;
}

/* Profile Card */
.profile-card {
  width: 300px;
  text-align: center;
}

.profile-card img {
  border-radius: 50%;
  border: 2px solid #fff;
  margin-bottom: 15px;
}

.profile-card h2 {
  margin-bottom: 5px;
}

.profile-card button {
  background-color: #007bff;
  color: white;
  padding: 8px 20px;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  margin-top: 15px;
}

.profile-card button:hover {
  background-color: #0056b3;
}

/* Orders Section */
.orders-section {
  flex-grow: 1;
  max-width: 700px;
}

.orders-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-top: 15px;
}

.order-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.order-card button {
  background-color: #28a745;
  color: white;
  padding: 6px 15px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
}

.order-card button:hover {
  background-color: #218838;
}

/* Order Details Page */
.order-details {
  display: flex;
  gap: 40px;
  margin: 60px auto;
  flex-wrap: wrap;
  justify-content: center;
  width: 90%;
}

.order-details .left-box, .order-details .right-box {
  width: 350px;
}

.order-details h2 {
  width: 100%;
  text-align: center;
  margin-bottom: 20px;
}

.order-details p {
  margin: 8px 0;
  line-height: 1.4;
}

/* Responsive Tweaks */
@media (max-width: 768px) {
  .account-wrapper, .order-details {
    flex-direction: column;
    align-items: center;
  }

  .order-details .left-box, .order-details .right-box {
    width: 90%;
  }
}


</style>
<body>
  <div class="order-details">
    <h2>Order #<?php echo $order['id']; ?></h2>
    <div class="left-box">
      <p><strong>Product:</strong> <?php echo $order['product_name']; ?></p>
      <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
      <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
      <p><strong>Estimated Completion:</strong> <?php echo $order['completion_date']; ?></p>
    </div>

    <div class="right-box">
      <h3>FILL UP FORM</h3>
      <p>Name: <?php echo $order['name']; ?></p>
      <p>Address: <?php echo $order['address']; ?></p>
      <p>Landmark: <?php echo $order['landmark']; ?></p>
      <p>Mode of Payment: <?php echo $order['payment_method']; ?></p>
      <p>Note: <?php echo $order['note']; ?></p>
      <p>ID of receiver: <?php echo $order['receiver_id']; ?></p>
      <p>Down Payment/COD: <?php echo $order['payment_note']; ?></p>
    </div>
  </div>
</body>
</html>
