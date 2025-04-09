<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $archive_id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM archive_admin WHERE Archive_ID = $archive_id");

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        $fullname = $conn->real_escape_string($admin['Fullname']);
        $email = $conn->real_escape_string($admin['Email']);
        $birthday = $admin['Birthday'];
        $billing_address = $conn->real_escape_string($admin['Billing_Address']);
        $pword = $conn->real_escape_string($admin['Pword']);
        $profile_photo = $conn->real_escape_string($admin['Profile_Photo']);
        $created_at = date('Y-m-d H:i:s'); 

        $insert = "INSERT INTO customers_info (Fullname, Email, User_lvl, Birthday, Billing_Address, Pword, Profile_Photo, Created_At)
                   VALUES ('$fullname', '$email', 3, '$birthday', '$billing_address', '$pword', '$profile_photo', '$created_at')";

        if ($conn->query($insert)) {
            $conn->query("DELETE FROM archive_admin WHERE Archive_ID = $archive_id");
            header("Location: admins_archive.php");
            exit();
        } else {
            echo "Error restoring admin: " . $conn->error;
        }

    } else {
        echo "Archived admin not found.";
    }
} else {
    echo "No archive ID provided.";
}
?>
