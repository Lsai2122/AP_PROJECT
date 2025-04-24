<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user-id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user-id'];

$conn = new mysqli("localhost", "root", "", "ap_project");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed']);
    exit();
}

$sql = "SELECT username,email FROM login_info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username,$email);

if ($stmt->fetch()) {
    echo json_encode(['success' => true, 'username' => $username,'id'=>$_SESSION['user-id'],'email' => $email]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

$stmt->close();
$conn->close();
