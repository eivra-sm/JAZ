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
                                <li class="nav-item">
                                    <a class="nav-link" href="createOrder.php">Create Order</a>
                                </li>
                                <li class="nav-item active">
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
            <div class="row tm-content-row tm-mt-big">
                <div class="col-xl-6 col-lg-6 col-md-12 tm-col mb-4">
                    <div class="bg-white tm-block h-100">   
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block">ORDER ID: [insert]</h2>
                        
                        <form action="" class="tm-edit-product-form">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Customer Name</label>
                                <div class="col-sm-8">
                                    <input id="name" name="name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Product" class="col-sm-4 col-form-label">Product</label>
                                <div class="col-sm-8">
                                    <textarea id="Product" name="Product" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Order_Date" class="col-sm-4 col-form-label">Order Date</label>
                                <div class="col-sm-8">
                                    <input id="Order_Date" name="Order_Date" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Status" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select id="Status" class="custom-select">
                                        <option selected>Select one</option>
                                        <option value="1">Not Yet Started</option>
                                        <option value="2">In Progress</option>
                                        <option value="3">Finished</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-sm-4 col-form-label">Estimated Completion Date</label>
                                <div class="col-sm-8">
                                    <input id="contact" name="contact" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-4 col-form-label">Price</label>
                                <div class="col-sm-8">
                                    <input id="price" name="price" type="text" class="form-control">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row">
                                <div class="col-sm-8 offset-sm-4">
                                    <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                                </div>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 tm-col mb-4">
                    <div class="card shadow p-4">
                        <h2 class="tm-block-title d-inline-block">FILL UP FORM</h2>

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
                                    <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <footer class="row tm-mt-small">
                <div class="col-12 font-weight-light">
                    <p class="d-inline-block tm-bg-black text-white py-2 px-4">
                        Copyright &copy; 2018 Admin Dashboard . Created by
                        <a rel="nofollow" href="https://www.tooplate.com" class="text-white tm-footer-link">Tooplate</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
        $(function () {
            $('.tm-product-name').on('click', function () {
                window.location.href = "edit-product.html";
            });
        })
    </script>
</body>
</html>