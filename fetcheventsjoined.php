<?php
session_start();
$host = "localhost";
$dbname = "ap_project";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

$user_id = $_SESSION['user-id'];

if ($user_id === null) {
    echo json_encode(["error" => "User ID is required"]);
    exit;
}

$sql = "SELECT *
        FROM event_main_details e
        JOIN joined j ON e.id = j.event_id
        WHERE j.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode(['data' => $events, 'n' => count($events)]);

$stmt->close();
$conn->close();
?>
