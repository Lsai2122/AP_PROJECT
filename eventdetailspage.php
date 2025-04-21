<?php 
    session_start();

    $id = $_SESSION['user-id'];
    $EventId = $_GET['event_id']
    include "pages/eventdetails.php";
?>