<?php include 'db_conn.php' ?>

<?php
if (isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $sql = "UPDATE product_lists SET Archive_Status='1' WHERE Product_ID='$id'";
    $result = $conn->query($sql);
    if($result === TRUE){
        $url = 'http://localhost/jaz/2108_dashboard/productsAr.php';
        header('Location: ' . $url, true, $permanent ? 301: 302);
    }
}

?> 