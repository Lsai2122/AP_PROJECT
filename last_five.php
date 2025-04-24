<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ap_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT * FROM event_main_details ORDER BY id DESC LIMIT 7";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $total_data=([
                    "n"=>$result->num_rows,
                    "data"=>$data
                    ]);
} else {
    $total_data=(["n"=>0]);
}
echo json_encode($total_data);
$conn->close();
?>
