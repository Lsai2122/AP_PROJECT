<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $conn = new mysqli("localhost", "root", "", "ap_project");
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'DB connection failed']);
        exit();
    }

    if (!empty($email)) {
        $stmt =$conn ->prepare("SELECT * FROM login_info WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['user-id'] = $user['id']; 

                echo json_encode([
                    'success' => true,
                    'id'=>$user['id']
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid password']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No user found with this email']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Email required']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
