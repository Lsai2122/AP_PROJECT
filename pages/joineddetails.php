
<?php
    include 'pages/header.php';

    $conn = new mysqli("localhost", "root", "", "ap_project");
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Connection failed']));
    }
    
    $event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;
    
    if ($event_id <= 0) {
        die(json_encode(['success' => false, 'message' => 'Invalid event_id']));
    }
    
    $stmt = $conn->prepare("
    SELECT j.*, m.*
    FROM members m
    JOIN joined j ON m.joined_id = j.joined_id
    WHERE j.event_id = ?
");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$joined_users = [];
while ($row = $result->fetch_assoc()) {
    $joined_users[] = $row;
}
foreach ($joined_users as &$row) {
    $row = array_map(function($value) {
        if (!is_string($value)) return $value;
        $value = str_replace(["\r\n", "\n", "\r"], ' ', $value);
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }, $row);
}
unset($row);



    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed']);
        exit();
    }

    $sql = "SELECT * FROM event_main_details WHERE id = $event_id";
    $result = $conn->query($sql);

    $data = [];
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $data[]=$row;
        }
    }
    foreach ($data as &$row) {
        $row = array_map(function($value) {
            return str_replace(["\r\n", "\n", "\r"], ' ', $value);
        }, $row);
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table page</title>
    <link rel="stylesheet" href="pages/styles/header.css">
    <link rel="stylesheet" href="pages/styles/Table_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Itim&display=swap" rel="stylesheet">
</head>
<body>
    <div class="Total-page">
    <div class="event-info-box">
            
        </div>
        <div class="table-container">
            <table class="table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Team Leader</th>
                  <th>Leader Email</th>
                  <th>Leader Contact</th>
                  <th>Leader Gender</th>
                  <th>Other Members</th>
                </tr>
              </thead>
              <tbody class="table-main">
                 
              </tbody>
            </table>
          </div>
          
    </div>
    <script>
        const joineddetails = <?php echo json_encode(['success' => true, 'data' => $joined_users], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        data =JSON.parse(`<?php echo json_encode($data[0]);?>`)
        console.log(joineddetails);
        const today = new Date();
        const targetDate = new Date(data['last_date']);

        const timeDiff = targetDate - today;
        const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        document.querySelector(".event-info-box").innerHTML=`
            <div class="border-line"></div>
            <div class="event-content">
                <div class="event-info">
                    <div class="event-details">
                        <h2 class="event-name">${data['event_name']}</h2>
                        <div class="loc">
                            <img src="images/location.png" class="loc-img">
                            <span class="loc-name">${data['state']}</span>
                        </div>
                        <div class="last-date">
                            <img src="images/calendar.png">
                            <span class="date">Last Date: ${data['last_date']}</span>
                        </div>
                    </div>
                    <img class="event-pic" src='images/eventimg.png'></img>
                </div>
                <div class="days-left">
                    <div class="number">${daysLeft}</div>
                    <div class="left">Days Left</div>
                </div>
            </div>
        `
        for(i=0;i<joineddetails.data.length;i++){
            details = joineddetails.data[i];
            console.log(details);
            document.querySelector(".table-main").innerHTML+=`
                <tr>
                  <td rowspan='${details['FilledMembers']}'>${i+1}</td>
                  <td rowspan='${details['FilledMembers']}'>${details['LeadName']}</td>
                  <td rowspan='${details['FilledMembers']}'>${details['LeadEmail']}</td>
                  <td rowspan='${details['FilledMembers']}'>${details['LeadNum']}</td>
                  <td rowspan='${details['FilledMembers']}'>${details['LeadGen']}</td>
                  <td>${details['Mem1']}</td>
                 </tr>
            `
            for(j=1;j<details['FilledMembers'];j++){
                document.querySelector(".table-main").innerHTML+=`
                    <tr>
                        <td>${details[`Mem${j+1}`]}</td>
                    </tr>
                `
            }
        }
    </script>
</body>
</html>