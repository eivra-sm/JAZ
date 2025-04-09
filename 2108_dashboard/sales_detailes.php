<?php
include 'db_connection.php';

if (isset($_GET['sale_id'])) {
    $sale_id = $_GET['sale_id'];

    $sql = "SELECT * FROM sales_summary WHERE Sale_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sale_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $sale = $result->fetch_assoc();
} else {
    die("No sale ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sale Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Sale Details - Sale ID: <?= htmlspecialchars($sale['Sale_ID']) ?></h2>
        <table class="table table-striped">
            <tr><th>Order ID</th><td><?= $sale['Order_ID'] ?></td></tr>
            <tr><th>Quantity</th><td><?= $sale['Quantity'] ?></td></tr>
            <tr><th>Price</th><td><?= $sale['Price'] ?></td></tr>
            <tr><th>Total Amount</th><td><?= $sale['Total_Amount'] ?></td></tr>
            <tr><th>Date</th><td><?= $sale['Order_Date'] ?></td></tr>
            <tr><th>Payment Status</th><td><?= $sale['Payment_Status'] ?></td></tr>
            <tr><th>Order Status</th><td><?= $sale['Order_Status'] ?></td></tr>
        </table>
        <a href="sales_summary.php" class="btn btn-secondary">Back to Sales Summary</a>
    </div>
</body>
</html>
