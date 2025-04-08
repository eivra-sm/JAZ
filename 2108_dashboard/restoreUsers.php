<?php include 'db_conn.php' ?>

<?php
if (isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $sql = "UPDATE accounts SET Status_Archive='1' WHERE Account_ID='$id'";
    $result = $conn->query($sql);
    if($result === TRUE){
        $url = 'http://localhost/RadAl/dashboard.php';
        header('Location: ' . $url, true, $permanent ? 301: 302);
    }
}

?>