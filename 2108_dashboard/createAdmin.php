<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "jaz_creation"); // change if needed
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fullname = $_POST['Fullname'] ?? '';
    $email = $_POST['Email'] ?? '';
    $birthday = $_POST['Birthday'] ?? '';
    $billing_address = $_POST['Billing_Address'] ?? '';
    $password = $_POST['Pword'] ?? '';
    $photoPath = "";

    if (isset($_FILES['Profile_Photo']) && $_FILES['Profile_Photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = time() . "_" . basename($_FILES['Profile_Photo']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['Profile_Photo']['tmp_name'], $targetPath)) {
            $photoPath = $targetPath;
        } else {
            echo "Failed to upload the image. Please try again.";
            exit;
        }
    }

    $sql = "INSERT INTO customers_info (Fullname, Email, Birthday, Billing_Address, Pword, User_lvl, Profile_Photo, Created_At)
            VALUES (?, ?, ?, ?, ?, 2, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fullname, $email, $birthday, $billing_address, $password, $photoPath);

    if ($stmt->execute()) {
        echo "✅ Admin with profile photo created.";
        echo '<br><a href="createAdmin.php">← Go back</a>';
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard for Super Admin</title>
    
    <!--
    Template 2108 Dashboard
	http://www.tooplate.com/view/2108-dashboard
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <!-- https://fullcalendar.io/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body id="reportsPage">
    <div class="" id="home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-xl navbar-light bg-light">
                        <a class="navbar-brand" href="#">
                            <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                        </a>
                        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboard.php">Sales
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="customers.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Customers List
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="customersLi.php">Customers List</a>
                                        <a class="dropdown-item" href="customersAr.php">Customers Archive</a>
                                    </div>
                                </li>
                                    <a class="nav-link" href="createAdmin.php">Create Admin Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="orders.php">Orders</a>
                                </li>
    
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link d-flex" href="login.html">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row tm-mt-big">
            <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Create New Admin</h2>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center tm-mt-big">
                <div class="tm-edit-product-form-container">
                    <form action="createAdmin.php" method="POST" enctype="multipart/form-data" class="tm-edit-product-form">
                        <div class="form-group">
                            <label for="Fullname">Full Name</label>
                            <input id="Fullname" name="Fullname" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input id="Email" name="Email" type="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Birthday">Birthday</label>
                            <input id="Birthday" name="Birthday" type="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Billing_Address">Billing Address</label>
                            <input id="Billing_Address" name="Billing_Address" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Pword">Password</label>
                            <input id="Pword" name="Pword" type="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Profile_Photo">Profile Photo</label>
                            <input id="Profile_Photo" name="Profile_Photo" type="file" class="form-control-file" accept="image/*">
                        </div>

                        <div class="form-group text-right mt-4">
                            <button type="submit" class="btn btn-primary">Create Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="row tm-mt-big">
            <div class="col-12 font-weight-light">
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
        $(function () {
            $('#expire_date').datepicker();
        });
    </script>             
</body>
</html>