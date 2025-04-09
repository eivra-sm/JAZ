<?php
include 'db_connection.php';

$sql = "SELECT * FROM order_lists";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>List of Orders</title>
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

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .table th {
            background-color:rgb(43, 117, 46);
            color: white;
            font-weight: bold;
        }

        .table td {
            font-size: 14px;
        }

        .back-btn {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table-bordered th {
            text-align: center;
        }

        .table-bordered td {
            text-align: center;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="dashboardSuperad.php" class="btn btn-primary mb-4">← Back to Dashboard</a>
        <h2 class="mb-4">List of Orders</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['Order_ID'] ?></td>
                    <td><?= $row['Customer_ID'] ?></td>
                    <td><?= $row['Order_Date'] ?></td>
                    <td><?= $row['Status'] ?></td>
                    <td><?= $row['Total_Amount'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
