<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM product_lists WHERE Product_ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
    
            $archived_at = date('Y-m-d H:i:s');
    
            $update_sql = "UPDATE product_lists 
               SET Archive_ID = '0', 
                   Archived_At = '$archived_at'
               WHERE Product_ID = $id";
            $conn->query($update_sql);
    
    
            header("Location: productsLi.php");
            exit();
        }
    }
}
?>
