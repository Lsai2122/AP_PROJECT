<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // DB Connection
    $conn = new mysqli("localhost", "root", "", "ap_project");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Check if email already exists
    $check = "SELECT * FROM login_info WHERE email = '$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        echo "Email already registered!";
    } else {
        $sql = "INSERT INTO login_info (username, phone, email, password)
                VALUES ('$username', '$phone', '$email', '$hashed_password')";

        if ($conn->query($sql)) {
            echo "Registered successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
