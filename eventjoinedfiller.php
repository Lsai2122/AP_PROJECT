<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user-id'] ?? null;
    $TeamName = $_POST['team-name'] ?? null;
    $LeadName = $_POST['lead-name'] ?? null;
    $LeadClg = $_POST['lead-college'] ?? null;
    $LeadGen = $_POST['lead-gender'] ?? null;
    $LeadEmail = $_POST['lead-email'] ?? null;
    $LeadNum = $_POST['lead-number'] ?? null;
    $FilledMembers = $_POST['current'] ?? 0;
    $event_id = $_POST['event_id'] ?? null;

    if (!$user_id || !$event_id) {
        echo json_encode(['success' => false, 'message' => 'User or Event ID missing']);
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "ap_project");
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed']);
        exit();
    }

    // Check if user already joined this event
    $checkStmt = $conn->prepare("SELECT joined_ id FROM joined WHERE user_id = ? AND event_id = ?");
    $checkStmt->bind_param("ii", $user_id, $event_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'You have already registered for this event']);
        $checkStmt->close();
        $conn->close();
        exit();
    }
    $checkStmt->close();

    // Insert into `joined`
    $stmt = $conn->prepare("INSERT INTO joined (event_id, user_id, LeadName, LeadClg, LeadEmail, LeadGen, LeadNum, FilledMembers)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssssi", $event_id, $user_id, $LeadName, $LeadClg, $LeadEmail, $LeadGen, $LeadNum, $FilledMembers);

    if ($stmt->execute()) {
        $JoinedId = $stmt->insert_id;
        $stmt->close();

        $Mem1 = $_POST['member-1-name'] ?? null;
        $Mem2 = $_POST['member-2-name'] ?? null;
        $Mem3 = $_POST['member-3-name'] ?? null;
        $Mem4 = $_POST['member-4-name'] ?? null;
        $Mem5 = $_POST['member-5-name'] ?? null;
        $Mem6 = $_POST['member-6-name'] ?? null;

        $stmt = $conn->prepare("INSERT INTO members (joined_id, Mem1, Mem2, Mem3, Mem4, Mem5, Mem6)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $JoinedId, $Mem1, $Mem2, $Mem3, $Mem4, $Mem5, $Mem6);
        $stmt->execute();
        $stmt->close();

        echo json_encode(['success' => true, 'message' => "Team and members added"]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Team insert failed']);
    }

    $conn->close();
}
?>
