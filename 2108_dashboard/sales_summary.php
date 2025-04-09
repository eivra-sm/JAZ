<?php
include 'db_connection.php';

$sql = "SELECT * FROM sales_summary";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sales Summary</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .back-btn {
            margin-bottom: 20px;
            font-size: 16px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
        }

        .table th {
            background-color:rgb(59, 141, 51);
            color: white;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Back Button -->
        <a href="dashboardSuperad.php" class="btn btn-primary back-btn">← Back to Dashboard</a>

        <h2 class="mb-4">Sales Summary</h2>

        <!-- Table for Sales Data -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['Sale_ID'] ?></td>
                                <td><?= $row['Order_ID'] ?></td>
                                <td><?= $row['Price'] ?></td>
                                <td><?= $row['Quantity'] ?></td>
                                <td><?= $row['Total_Amount'] ?></td>
                                <td><?= $row['Order_Date'] ?></td>
                                <td><?= $row['Payment_Status'] ?></td>
                                <td><?= $row['Order_Status'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="8">No records found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
