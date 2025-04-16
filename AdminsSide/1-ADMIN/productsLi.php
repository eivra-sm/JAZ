<?php 
include 'db_connection.php';
session_start();

// Get admin profile photo
$sql_admin = "SELECT Profile_Photo FROM customers_info WHERE User_lvl = 1";
$result_admin = $conn->query($sql_admin);
$admin = $result_admin->fetch_assoc();
$profile_photo = $admin ? $admin['Profile_Photo'] : 'default-profile.png';

// Search logic
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_term = "%" . $search . "%";

$sql = "SELECT * FROM product_lists WHERE Archive_ID !=0";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();


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

<style>
    .table-responsive {
        width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    thead {
        background-color: #343a40;
        color: #ffffff;
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
        border: 1px solid #dee2e6;
        vertical-align: middle;
    }

    tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    tbody tr:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }

    .tm-block-title {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    /* Optional: Responsive behavior for small screens */
    @media (max-width: 768px) {
        th, td {
            font-size: 0.9rem;
            padding: 8px;
        }
    }
    .popup {
  display: none;
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
  z-index: 1000;
  width: 90%;          /* Increased from max-width to fixed width */
  max-width: 700px;    /* Allow more content width */
  overflow-y: auto;
  max-height: 90vh;    /* Keep it scrollable if too tall */
}

.popup-content {
  width: 100%;
  padding: 20px 30px;
  border-radius: 10px;
  text-align: left;
  position: relative;
  background: white;
}

.close-btn {
  position: absolute;
  top: 12px;
  right: 18px;
  font-size: 22px;
  font-weight: bold;
  color: #555;
  cursor: pointer;
}

.close-btn:hover {
  color: #000;
}

h2 {
  margin-bottom: 20px;
  font-size: 22px;
  font-weight: 600;
  color: #333;
}

.field-container {
  margin-bottom: 16px;
  text-align: left;
}

.field-container label {
  font-weight: 600;
  display: block;
  margin-bottom: 6px;
  font-size: 15px;
  color: #333;
}

input[type="text"], select {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
  box-sizing: border-box;
  transition: border-color 0.2s ease;
}

input:focus, select:focus {
  border-color: #007BFF;
  outline: none;
}

.dropdown-wrapper {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  justify-content: space-between;
}

.dropdown-container {
  flex: 1;
  min-width: 48%;
}

.update-btn {
  background-color: #007BFF;
  color: white;
  padding: 12px 24px;
  font-size: 16px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  float: right;
}

.update-btn:hover {
  background-color: #0056b3;
}

/* Responsive adjustments */
@media (max-width: 600px) {
  .popup {
    width: 95%;
    max-width: none;
  }

  .popup-content {
    padding: 20px;
  }

  .dropdown-wrapper {
    flex-direction: column;
    gap: 10px;
  }

  .dropdown-container {
    min-width: 100%;
  }

  .update-btn {
    width: 100%;
    float: none;
  }
  .create-button {
            display: flex;
            justify-content: flex-start;  
            align-items: center; 
            margin-bottom: 10px;
            margin-left: 10px; 
        }
        .create-button a {
            padding: 10px 20px; 
            background-color:rgb(189, 118, 71);  
            color: white;
            font-size: 16px;
            border-radius: 25px;  
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            transition: background-color 0.3s, transform 0.3s ease-in-out;
            display: inline-flex;
        }
        .create-button a:hover {
            background-color:rgb(73, 143, 85);  
            transform: translateY(-2px); 
        }
        .create-button a:active {
            transform: translateY(1px); 
        }
}

</style>

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
                                <li class="nav-item dropdown active">
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
            <div class="row tm-content-row tm-mt-big">
                <div class="col-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block">Products</h2>
                            </div>
                            <div class="create-button">
                                <a href="addProducts.php" class="btn">Create New Product</a>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                        <table border="1">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Category</th>
                                        <th>Images</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['Product_ID']; ?></td>
                                        <td><?php echo $row['Product_Name']; ?></td>
                                        <td><?php echo $row['Descrip']; ?></td>
                                        <td><?php echo $row['Price']; ?></td>
                                        <td><?php echo $row['Stock']; ?></td>
                                        <td><?php echo $row['Category']; ?></td>
                                        <td><?php echo $row['Images']; ?></td>
                                        <td>
                                            <a href="edit_prod.php?id=<?php echo $row['Product_ID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete_prod.php?id=<?php echo $row['Product_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
        function archiveProducts(id) {
            let text = "Are you sure you want to \nArchive This Record?";
            if(confirm(text) == true){
                window.location="http://localhost/jaz/2108_dashboard/archiveProducts.php?id="+id;
            }
        }

        function addProduct() {
            let confirmAction = confirm("Are you sure you want to add a new product?");
            if (confirmAction) {
                window.location = "http://localhost/jaz/2108_dashboard/addProducts.php";
            }
        }

    </script>
</body>
</html>