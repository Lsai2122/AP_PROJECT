<?php
$host = "localhost";
$dbname = "ap_project";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

$sql = "
    SELECT e.id, e.event_name, COUNT(j.user_id) AS total_joined
    FROM event_main_details e
    JOIN joined j ON e.id = j.event_id
    GROUP BY e.id
    ORDER BY total_joined DESC
    LIMIT 6;
";

$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode(['data'=>$events,'n'=>$result->num_rows]);
$conn->close();
?>
