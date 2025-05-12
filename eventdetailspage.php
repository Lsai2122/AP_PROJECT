<?php 
    session_start();
    $id = $_SESSION['user-id'];
    $EventId = $_GET['event_id'];
    $id = intval($id);
    $EventId = intval($EventId);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ap_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "
        SELECT 1 FROM event_main_details 
        WHERE user_id = $id AND id = $EventId
        LIMIT 1;
    ";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        include 'pages/joineddetails.php' ;
    } else {
        include "pages/eventdetails.php";
    }


?>