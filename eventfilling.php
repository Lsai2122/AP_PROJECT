<?php 
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION["user-id"] ?? null; // ✅ FIXED session key

    // Basic validation
    if ($user_id==-1) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit();
    }

    // Get event data
    $event_name = $_POST['event_name'] ?? '';
    $date_sub = $_POST['date_sub'] ?? '';
    $time_sub = $_POST['time_sub'] ?? '';
    $state = $_POST['state'] ?? '';
    $venue = $_POST['venue'] ?? '';
    $rounds = intval($_POST['rounds'] ?? 0);
    $max_members = $_POST['max_members'] ?? '';
    $price = $_POST['price'] ?? '';

    // Round arrays
    $names = [];
    $dates = [];
    $times = [];
    $durations = [];
    $details_of_round = [];
    $modes = [];

    for ($i = 1; $i < $rounds+1; $i++) {
        $names[] = $_POST["name$i"];
        $dates[] = $_POST["date$i"];
        $times[] = $_POST["time$i"];
        $durations[] = $_POST["duration$i"];
        $details_of_round[] = $_POST["details_of_round$i"];
        $modes[] = ($_POST["mode$i"]) === 'offline' ? 0 : 1;
    }

    // DB Connection
    $conn = new mysqli("localhost", "root", "", "ap_project");
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed']);
        exit();
    }

    // Insert main event
    $stmt1 = $conn->prepare("INSERT INTO event_main_details (user_id, event_name, last_date, last_time, state, venue, rounds, max_members, price_pool)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param("isssssiii", $user_id, $event_name, $date_sub, $time_sub, $state, $venue, $rounds, $max_members, $price);

    if ($stmt1->execute()) {
        $event_id = $stmt1->insert_id; // ✅ get inserted event ID
        $stmt1->close();

        // Loop through rounds
        for ($i = 0; $i < $rounds; $i++) {
            $table = "round" . ($i+1); // Table name must exist
            $stmt2 = $conn->prepare("INSERT INTO $table (eventid, round_name, date, time, duration, details, is_online)
            VALUES (?, ?, ?, ?, ?, ?, ?)");
            

            if (!$stmt2) {
            echo json_encode(['success' => false, 'message' => 'Prepare failed for round table: ' . $conn->error]);
            exit();
            }
            $stmt2->bind_param("isssssi", $event_id, $names[$i], $dates[$i], $times[$i], $durations[$i], $details_of_round[$i], $modes[$i]);
            $stmt2->execute();
            $stmt2->close();
        }

        echo json_encode(['success' => true, 'message' => 'Event and rounds added']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Event insert failed']);
    }

    $conn->close();
}
?>
