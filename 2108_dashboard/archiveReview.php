<?php include 'db_conn.php' ?>

<?php
if (isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $sql = "UPDATE review SET Archive_Status='0' WHERE Review_ID='$id'";
    $result = $conn->query($sql);
    if($result === TRUE){
        $url = 'http://localhost/jaz/2108_dashboard/reviewsLi.php';
        header('Location: ' . $url, true, $permanent ? 301: 302);
    }
}
?> 