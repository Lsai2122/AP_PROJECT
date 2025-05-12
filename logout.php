<?php
session_start();
$_SESSION['user-id']=-1;
header("Location: login.php");
exit();
?>
