<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "jaz_creation"); 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $Product_Name = $_POST['Product_Name'] ?? '';
    $Descrip = $_POST['Descrip'] ?? '';
    $Price = $_POST['Price'] ?? '';
    $Stock = $_POST['Stock'] ?? '';
    $Category = $_POST['Category'] ?? '';
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

    $sql = "INSERT INTO product_lists (Product_Name, Descrip, Price, Stock, Category, Images, Created_At, Archive_ID, Archived_At)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), 1, NULL)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $Product_Name, $Descrip, $Price, $Stock, $Category, $photoPath);

    if ($stmt->execute()) {
        echo "Product Added.";
        echo '<br><a href="addUser.php">← Go back</a>';
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<style>
.create-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(197, 9, 9, 0.53);
        }

</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard for Super Admin</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/fullcalendar.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tooplate.css">
</head>

<a href="productsLi.php" class="btn btn-primary mb-4">← Back to Dashboard</a>

<body id="reportsPage">
    <div class="" id="home">
        <div class="create-container">
                <div class="col-12">
                    <h2 class="text-center mb-4">Add Product</h2>
                </div>
                <div class="tm-edit-product-form-container">
                    <form action="addProducts.php" method="POST" enctype="multipart/form-data" class="tm-edit-product-form">
                        <div class="form-group">
                            <label for="Product_Name">Product Name</label>
                            <input id="Product_Name" name="Product_Name" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Descrip">Description</label>
                            <input id="Descrip" name="Descrip" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Price">Price</label>
                            <input id="Price" name="Price" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Stock">Stock</label>
                            <input id="Stock" name="Stock" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Category">Category</label>
                            <input id="Category" name="Category" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Images">Images</label>
                            <input id="Images" name="Images" type="file" class="form-control-file" accept="image/*">
                        </div>

                        <div class="form-group text-right mt-4">
                            <button type="submit" class="btn btn-primary">Add Product</button>
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

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../jquery-ui-datepicker/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#expire_date').datepicker();
        });
    </script>             
</body>
</html>
