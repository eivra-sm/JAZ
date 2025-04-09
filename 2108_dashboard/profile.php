<?php
include 'db_connection.php';

$sql = "SELECT * FROM customers_info WHERE User_lvl = 1 ";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $billing_address = $_POST['billing_address'];

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['profile_photo']['name']);
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target_file);
        $profile_photo = basename($_FILES['profile_photo']['name']);
    } else {
        $profile_photo = $admin['Profile_Photo'];
    }

    $update_sql = "UPDATE customers_info SET Fullname = ?, Email = ?, Birthday = ?, Billing_Address = ?, Profile_Photo = ? WHERE ID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssi", $fullname, $email, $birthday, $billing_address, $profile_photo, $admin['ID']);
    $stmt->execute();

    header('Location: profile.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Admin Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
</head>

<body>
    <div class="container">
        <h2 class="my-4">Super Admin Information</h2>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $admin['Fullname']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin['Email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $admin['Birthday']; ?>" required>
            </div>

            <div class="form-group">
                <label for="billing_address">Billing Address</label>
                <input type="text" class="form-control" id="billing_address" name="billing_address" value="<?php echo $admin['Billing_Address']; ?>" required>
            </div>

            <div class="form-group">
                <label for="profile_photo">Profile Photo</label>
                <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
                <img src="uploads/<?php echo $admin['Profile_Photo']; ?>" alt="Profile Picture" class="mt-2" style="width: 100px; height: 100px; object-fit: cover;">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
