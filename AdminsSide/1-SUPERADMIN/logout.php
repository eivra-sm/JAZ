<?php
session_start();
session_destroy();
header("Location: ../../GuestSide/index.php");
exit();
?>
