<?php
include 'db_connection.php';
session_start();

    if (!empty($_POST['Fullname']) && !empty($_POST['Email']) && 
        !empty($_POST['Birthday']) && !empty($_POST['Billing_Address']) && !empty($_POST['Pword']) &&
        !empty($_POST['Profile_Photo'])) {

        $Fullname = $_POST['Fullname'];
        $Email = $_POST['Email'];
        $Birthday = $_POST['Birthday'];
        $Billing_Address = $_POST['Billing_Address'];
        $Pword = $_POST['Pword'];
        $Profile_Photo = $_POST['Profile_Photo'];

        // Check if the product already exists by name (optional, depending on your needs)
        $checkstmt = $conn->prepare("SELECT Email FROM accounts WHERE Email = ?");
        $checkstmt->bind_param("s", $Email);
        $checkstmt->execute();
        $checkstmt->store_result();

        if ($checkstmt->num_rows > 0) {
            $_SESSION['user_exists'] = "Account already exists. Please choose another email.";
            header("Location: createOrder.php");
            exit();
        } else {
            // Insert new product
            $sql = "INSERT INTO accounts (Fullname, Email, Birthday, Billing_Address, Pword, Profile_Photo, Status_Archive) 
                    VALUES (?, ?, ?, ?, ?, ?, '1')";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $Fullname, $Email, $Birthday, $Billing_Address, $Pword, $Profile_Photo);

            if ($stmt->execute()) {
                header("Location: accountsLi.php"); // Redirect to product list after successful insertion
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkstmt->close();
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin Template by Tooplate.com</title>
    <!--

    Template 2108 Dashboard

	http://www.tooplate.com/view/2108-dashboard

    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../css/fullcalendar.min.css">
    <!-- https://fullcalendar.io/ -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../css/tooplate.css">
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
                                    <a class="nav-link" href="dashboard.php">Sales Summary
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="customers.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Accounts List
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="accountsLi.php">Accounts List</a>
                                        <a class="dropdown-item" href="accountsAr.php">Accounts Archive</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="products.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Products
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="productsLi.php">Products List</a>
                                        <a class="dropdown-item" href="productsAr.php">Products Archive</a>
                                    </div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="createOrder.php">Create Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="orders.php">Orders</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link d-flex" href="logout.php">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-mt-big">
            <div class="col-12 tm-col">
                <div class="bg-white tm-block">
                <div class="row mt-4 tm-edit-product-row">
                    <!-- Left column: form fields -->
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <form action="" class="tm-edit-product-form">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Customer Name</label>
                                <div class="col-sm-8">
                                    <input id="name" name="name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <textarea id="address" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="landmark" class="col-sm-4 col-form-label">Landmark</label>
                                <div class="col-sm-8">
                                    <input id="landmark" name="landmark" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-sm-4 col-form-label">Contact #</label>
                                <div class="col-sm-8">
                                    <input id="contact" name="contact" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="order" class="col-sm-4 col-form-label">Order</label>
                                <div class="col-sm-8">
                                    <input id="order" name="order" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="MoP" class="col-sm-4 col-form-label">Mode of Payment</label>
                                <div class="col-sm-8">
                                    <select id="MoP" class="custom-select">
                                        <option selected>Select one</option>
                                        <option value="1">Cras efficitur lacus</option>
                                        <option value="2">Pellentesque molestie</option>
                                        <option value="3">Sed feugiat nulla</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="note" class="col-sm-4 col-form-label">Note for your order</label>
                                <div class="col-sm-8">
                                    <input id="note" name="note" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="DPcod" class="col-sm-4 col-form-label">Down Payment/COD</label>
                                <div class="col-sm-8">
                                    <input id="DPcod" name="DPcod" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-4 col-form-label">Price</label>
                                <div class="col-sm-8">
                                    <input id="price" name="price" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ecd" class="col-sm-4 col-form-label">Estimated Completion Date</label>
                                <div class="col-sm-8">
                                    <input id="ecd" name="ecd" type="text" class="form-control">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row">
                                <div class="col-sm-8 offset-sm-4">
                                    <button type="submit" class="btn btn-success btn-block">Submit Order</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Right column: file upload -->
                    <div class="col-xl-4 col-lg-4 col-md-12 mx-auto mb-4">
                        <label for="fileInput" class="col-form-label">Customer's Valid ID</label>
                        <div class="tm-product-img-dummy text-center my-3">
                            <i class="fas fa-5x fa-cloud-upload-alt" onclick="document.getElementById('fileInput').click();" style="cursor:pointer;"></i>
                        </div>
                        <div class="custom-file mt-3">
                            <input id="fileInput" type="file" style="display:none;" />
                            <input type="button" class="btn btn-primary d-block mx-auto" value="Upload..." onclick="document.getElementById('fileInput').click();" />
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <footer class="row tm-mt-big">
            <div class="col-12 font-weight-light">
                <p class="d-inline-block tm-bg-black text-white py-2 px-4">
                    Copyright &copy; 2018 Admin Dashboard . Created by
                    <a rel="nofollow" href="https://www.tooplate.com" class="text-white tm-footer-link">Tooplate</a>
                </p>
            </div>
        </footer>
    </div>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
        $(function () {
            $('#expire_date').datepicker();
        });
    </script>             
</body>
</html>