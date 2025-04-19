<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user-id'] ?? null;
    $TeamName = $_POST['team-name'];
    $LeadName = $_POST['lead-name'];
    $LeadClg = $_POST['lead-college'];
    $LeadGen = $_POST['lead-gender'];
    $LeadEmail = $_POST['lead-email'];
    $LeadNum = $_POST['lead-number'];
    $FilledMembers = $_POST['current'];
    $event_id = $_POST['event_id'];

    $conn = new mysqli("localhost", "root", "", "ap_project");
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed']);
        exit();
    }

    // Insert into `joined`
    $stmt = $conn->prepare("INSERT INTO joined (event_id, user_id, LeadName, LeadClg, LeadEmail, LeadGen, LeadNum, FilledMembers)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssssi", $event_id, $user_id, $LeadName, $LeadClg, $LeadEmail, $LeadGen, $LeadNum, $FilledMembers);

    if ($stmt->execute()) {
        $JoinedId = $stmt->insert_id;
        $stmt->close();

        // Collect member data
        $Mem1 = $_POST['member-1-name'] ?? null;
        $Mem2 = $_POST['member-2-name'] ?? null;
        $Mem3 = $_POST['member-3-name'] ?? null;
        $Mem4 = $_POST['member-4-name'] ?? null;
        $Mem5 = $_POST['member-5-name'] ?? null;
        $Mem6 = $_POST['member-6-name'] ?? null;

        // Insert into `members`
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
