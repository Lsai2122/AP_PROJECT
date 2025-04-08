<?php
if (isset($_POST['submit']) && $_POST["submit"] == "Login") {
    $username = $_POST['email'];
    $password = $_POST['password'];

    echo $username . "<br>";
    echo $password . "<br>";
    $conn = new mysqli("localhost", "root", "", "ap_project");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO login_info ("
} else {
    echo "Please submit the form.";
}
?>
