<?php
include 'db_connection.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM archive_admin";
if ($search) {
    $sql .= " WHERE Fullname LIKE '%$search%' OR User_lvl LIKE '%$search%' OR Birthday LIKE '%$search%' OR Billing_Address LIKE '%$search%' OR Archived_At LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Archived Admins</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: calc(100% - 35px); 
            max-width: 500px;
            padding: 10px 35px 10px 15px;
            font-size: 16px;
            border-radius: 25px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
        }

        .search-input:focus {
            border-color:rgb(116, 51, 13);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .search-button {
            position: absolute;
            top: 20%;
            right: 15px;
            background-color: transparent;
            border: none;
            color: #7ac27e;
            font-size: 18px;
            cursor: pointer;
        }

        .search-button:hover {
            color: rgb(19, 121, 28);
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <a href="dashboardSuperad.php" class="btn btn-primary mb-4">← Back to Dashboard</a>
    
    <h2>Archived Admins</h2>

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
            <form method="GET" class="d-flex justify-content-center w-75">
                <div class="search-container w-100">
                    <input type="text" name="search" class="search-input" placeholder="Search Archived Admins..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>User Level</th>
                <th>Birthday</th>
                <th>Billing Address</th>
                <th>Archived At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
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
            <?php else: ?>
                <tr><td colspan="6">No records found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
