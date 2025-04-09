<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM customers_info WHERE ID = $id AND User_lvl = 2";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        $original_id = $admin['ID'];
        $fullname = $conn->real_escape_string($admin['Fullname']);
        $user_lvl = intval($admin['User_lvl']);
        $birthday = $admin['Birthday'];
        $billing_address = $conn->real_escape_string($admin['Billing_Address']);
        $pword = $conn->real_escape_string($admin['Pword']);
        $profile_photo = isset($admin['Profile_Photo']) ? $conn->real_escape_string($admin['Profile_Photo']) : '';
        $archived_at = date('Y-m-d H:i:s');

        $insert_sql = "INSERT INTO archive_admin (
            Original_Customer_ID, Fullname, User_lvl, Birthday, Billing_Address, Pword, Profile_Photo, Archived_At
        ) VALUES (
            $original_id, '$fullname', $user_lvl, '$birthday', '$billing_address', '$pword', '$profile_photo', '$archived_at'
        )";
        $conn->query($insert_sql);

        $conn->query("DELETE FROM customers_info WHERE ID = $id");

        header("Location: admins_archive.php");
        exit();
    }
}
?>
