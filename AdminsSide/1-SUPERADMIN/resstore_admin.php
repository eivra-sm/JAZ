<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM customers_info WHERE ID = $id AND User_lvl = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
    
            $archive_id = rand(100, 999);
            $archived_at = date('Y-m-d H:i:s');
    
            $update_sql = "UPDATE customers_info 
               SET Archive_ID = '$archive_id', 
                   Archived_At = '$archived_at', 
                   User_lvl = 3 
               WHERE ID = $id";
            $conn->query($update_sql);
    
            header("Location: admins_archive.php");
            exit();
        }
    }
}
?>
