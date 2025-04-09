<?php
include 'db_connection.php';

$sql = "SELECT * FROM archive_admin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Archived Admins</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Archived Admins</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>User Level</th>
                <th>Birthday</th>
                <th>Billing Address</th>
                <th>Archived At</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['Fullname']) ?></td>
                <td><?= htmlspecialchars($row['User_lvl']) ?></td>
                <td><?= htmlspecialchars($row['Birthday']) ?></td>
                <td><?= htmlspecialchars($row['Billing_Address']) ?></td>
                <td><?= htmlspecialchars($row['Archived_At']) ?></td>
                <td>
                    <a href="resstore_admin.php?id=<?= $row['Archive_ID'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Restore this admin account?')">Restore</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>

    </table>
</div>
</body>
</html>
