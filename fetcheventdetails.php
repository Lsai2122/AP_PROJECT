<?php
$host = "localhost";
$dbname = "ap_project";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

$event_id = isset($_POST['event_id']) ? $_POST['event_id'] : null;

if ($event_id === null) {
    echo json_encode(["error" => "Event ID is required"]);
    exit;
}

// Get event main details
$sql = "SELECT e.id, e.event_name, e.last_date, e.state
        FROM event_main_details e
        WHERE e.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["error" => "Event not found"]);
    exit;
}

$event = $result->fetch_assoc();
$stmt->close();

// Function to fetch round data
function getRoundData($conn, $table, $event_id) {
    $sql = "SELECT * FROM `$table` WHERE eventid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

// Fetch data from round1 to round5
for ($i = 1; $i <= 5; $i++) {
    $roundTable = "round" . $i;
    $event["round" . $i] = getRoundData($conn, $roundTable, $event_id);
}

$conn->close();

// Final output
echo json_encode(['data' => $event]);
?>
