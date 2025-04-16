<?php 
include 'db_connection.php';
session_start();?>

<?php
$searchErr = '';
// Initialize arrays BEFORE calling the function
$ar_prod = array();

// Fetch all accounts
$sql = "SELECT * FROM product_lists";
$prods = $conn->query($sql);

// Call the function and store the returned arrays properly
$resultArrays = searchProds($prods);
$ar_prods = $resultArrays['prods'];

function searchProds($prods) {
    // Declare arrays inside the function
    $ar_prods = [];

    while ($row = $prods->fetch_assoc()) {
        $Obj = [
            'Product_ID' => $row["Product_ID"],
            'Product_Name' => $row["Product_Name"],
            'Descrip' => $row["Descrip"],
            'Price' => $row["Price"],
            'Stock' => $row["Stock"],
            'Category' => $row["Category"],
            'Images' => $row["Images"],
            'Created_At' => $row["Created_At"],
            'Archive_Status' => $row["Archive_Status"]
        ];
        switch ($Obj['Archive_Status']) {
            case 1:
                $ar_prods[] = $Obj;
                break;
        } }
    return [
        'prods' => $ar_prods
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {  
    $action = $_POST['action'];
  
      if($action == "updProd" && isset($_POST['Product_ID'])){
        $Product_ID = $_POST['Product_ID'];
        $sql = "SELECT * FROM product_lists WHERE Product_ID=$Product_ID";
        $result = $conn->query($sql);
        
          if ($result && $row = $result->fetch_assoc()) {
              echo json_encode([
                  "success" => true,
                    "Product_ID" => $row['Product_ID'],
                    "Product_Name" => $row['Product_Name'],
                    "Descrip" => $row['Descrip'],
                    "Price" => $row['Price'],
                    "Stock" => $row['Stock'],
                    "Category" => $row['Category'],
                    "Images" => $row['Images'],
                    "Created_At" => $row['Created_At'],
                    "Archive_Status" => $row['Archive_Status']
              ]);
          }else {
            echo json_encode(["success" => false, "message" => "User not found"]);
        }
        exit;
      }
      
      if($action == "updateProd" && isset($_POST['Product_ID'])){
        $Product_ID = $_POST['Product_ID'];
        
          if (isset($_POST['Product_ID'], $_POST['Product_Name'], $_POST['Descrip'], $_POST['Price'], $_POST['Stock'], $_POST['Category'], $_POST['Images'], $_POST['Created_At']) && $_POST['Product_ID'] !== "" && $_POST['Product_Name'] !== "" && $_POST['Descrip'] !== "" && $_POST['Price'] !== "" && $_POST['Stock'] !== "" && $_POST['Category'] !== "" && $_POST['Images'] !== "" && $_POST['Created_At'] !== "") {
  
                $Product_ID = $_POST['Product_ID'];
                $Product_Name = $_POST['Product_Name'];
                $Descrip = $_POST['Descrip'];
                $Price = $_POST['Price'];
                $Stock = $_POST['Stock'];
                $Category = $_POST['Category'];
                $Images = $_POST['Images'];
                $Created_At = $_POST['Created_At'];
                
                $sql = "UPDATE product_lists SET Product_ID='$Product_ID', Product_Name='$Product_Name', Descrip='$Descrip', Price='$Price', Category='$Category', Images='$Images', Stock='$Stock', Created_At='$Created_At' WHERE Product_id='$Product_ID'";
  
              if ($conn->query($sql)) {
                  echo json_encode(["success" => true, "message" => "Record updated successfully"]);
              } else {
                  echo json_encode(["success" => false, "message" => "Error updating record: " . $conn->error]);
              }
          } else {
              echo json_encode(["success" => false, "message" => "Please complete all fields!"]);
          } 
          exit;
      }
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
                                    <a class="nav-link" href="dashboard.php">Sales
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
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="reviews.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Reviews
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="reviewsLi.php">Reviews List</a>
                                        <a class="dropdown-item" href="reviewsAr.php">Reviews Archive</a>
                                    </div>
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
            <!-- row -->
            <div class="row tm-content-row tm-mt-big">
                <div class="col-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block">Products</h2>
                            </div>
                            <div class="col-md-4 col-sm-12 text-right">
                                <button type="button" onclick="addProduct()" id="addBtn">Add Product</button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Images</th>
                                <th>Created_At</th>
                                <th>Edit</th>
                                <th>Archive</th>
                            </tr>
                            </thead>
                            <tbody>
                    <?php
                        foreach ($ar_prods as $user) {
                            $tr = "<tr>";
                            $tr .= "<td>";
                            $id = $user['Product_ID'];
                            $tr .= $user['Product_ID'];
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= $user['Product_Name'];
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= $user['Descrip'];
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= $user['Price'];
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= $user['Stock'];
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= $user['Category'];
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= $user['Images'];
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= $user['Created_At'];
                            $tr .= "</td>";         
                            $tr .= "<td>";
                            $tr .= "<button class='btn' onclick='openPopup($id)'>Edit</button>";
                            $tr .= "</td>";
                            $tr .= "<td>";
                            $tr .= "<button class='btn' onclick='archiveProducts($id)'>Archive</button>";
                            $tr .= "</td>";
                            $tr .= "</tr>";
                            echo $tr;
                        }
                    ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="updatePopup" class="popup">
                <div class="popup-content">
                  <span class="close-btn" onclick="closePopup()">&times;</span>
                  <h2>Update Product Info</h2>
                  <form action="productsLi.php" method="POST" id="updateProdForm">
                    <input type="hidden" id="IdInputProd" name="Product_ID" value="">
                        <div class="field-container">
                            <label for="Product_ID">Product ID</label>
                            <input type="text" id="Product_ID" name="Product_ID" value="<?php echo $Product_ID;?>" required>
                        </div>

                        <div class="field-container">
                            <label for="Product_Name">Product Name</label>
                            <input type="text" id="Product_Name" name="Product_Name" value="<?php echo $Product_Name;?>" required>
                        </div>

                        <div class="field-container">
                            <label for="Descrip">Description</label>
                            <input type="text" id="Descrip" name="Descrip" value="<?php echo $Descrip;?>" required>
                        </div>

                        <div class="field-container">
                            <label for="Price">Price</label>
                            <input type="text" id="Price" name="Price" value="<?php echo $Price;?>" required>
                        </div>

                        <div class="field-container">
                            <label for="Stock">Stock</label>
                            <input type="text" id="Stock" name="Stock" value="<?php echo $Stock;?>" required>
                        </div>

                        <div class="dropdown-wrapper">
                            <div class="dropdown-container">
                                <label for="Category">Category</label>
                                <select id="Category" name="Category">
                                    <option value="<?php echo $Category;?>">Category</option>
                                    <option value="Chair">Chair</option>
                                    <option value="Bed">Bed</option>
                                    <option value="Table">Table</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="field-container">
                            <label for="Images">Images</label>
                            <input type="text" id="Images" name="Images" value="<?php echo $Images;?>" required>
                        </div>
                        
                        <br>

                        <button type="submit" class="update-btn" name="updateProd">UPDATE</button><br><br>
                    </form>
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