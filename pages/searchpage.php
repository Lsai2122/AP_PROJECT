<?php
$id = $_SESSION['user-id'];
    include('header.php');
    $search = $_GET['search'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ap_project"; // replace with your DB name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($search=='new'){

        $sql = "SELECT * FROM event_main_details ORDER BY id DESC LIMIT 30"; // replace 'your_table' and 'id' as needed
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
        $conn->close();
    }
    elseif($search=='best'){
        $sql = "
            SELECT e.id, e.event_name,e.last_date,e.state, COUNT(j.user_id) AS total_joined
            FROM event_main_details e
            JOIN joined j ON e.id = j.event_id
            GROUP BY e.id
            ORDER BY total_joined DESC
            LIMIT 30;
        ";

        $result = $conn->query($sql);

        $events = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }
            $total_data = ['data'=>$events,'n'=>$result->num_rows];
            $conn->close();
    }
    elseif($search=='upcoming'){
            $sql = "
                SELECT 
                    e.id,
                    e.event_name,
                    e.last_date,e.state,
                    DATEDIFF(e.last_date, CURDATE()) AS days_left
                FROM 
                    event_main_details e
                WHERE 
                    DATEDIFF(e.last_date, CURDATE()) >= 0
                ORDER BY 
                    days_left ASC
                LIMIT 30;
            ";

            $result = $conn->query($sql);

            $events = [];

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $events[] = $row;
                }
            }

            // Store in $total_data
            $total_data = [
                'data' => $events,
                'n' => count($events)
            ];

            $conn->close();

    }
    elseif($search=='hosted'){
        // Set your user ID
        $user_id = $_SESSION['user-id']; // Change this to the actual user ID

        $sql = "
            SELECT 
                e.id,
                e.event_name,
                e.state,
                e.venue,
                e.last_date
            FROM 
                event_main_details e
            WHERE 
                e.user_id = $user_id;
        ";

        $result = $conn->query($sql);

        $events = [];

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }

        // Store in $total_data
        $total_data = [
            'data' => $events,
            'n' => count($events)
        ];

        $conn->close();
    }
    else{
        $sql = "
        SELECT 
        e.id,
        e.event_name,
        e.state,
        e.venue,
        e.last_date
    FROM 
        event_main_details e
    WHERE 
        e.event_name LIKE '%$search%'
            ;
    ";
    $result = $conn->query($sql);

        $events = [];

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }

        // Store in $total_data
        $total_data = [
            'data' => $events,
            'n' => count($events)
        ];

        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="pages/styles/list_of_events.css">
</head>
<body onload="checklogin()">
    <div class="details_body">
        <div class="details_body_top">
            <input class="body_search" placeholder="Search Events">
            <p>Search results for : <?php echo $search?></p>
        </div>
        <div class="details_body_bottom">
        </div>
    </div>
    <div class="logininfocontainer">
        <div class="logininfo"></div>
    </div>
    <div class="login-into"></div>
    <div class="login-info-container">
    </div>
    <script>
        function checklogin(){
            fetch("session.php")
            .then(res => res.text())
            .then(html => {
                if(html=='-1'){
                    document.querySelector(".head-login").innerHTML = '<button class="head-login-button" onclick="LoginDisplay()">Login</button>';
                    document.querySelector(".logininfo").innerHTML = 'not signed in'
                }
                else{
                    document.querySelector(".head-login").innerHTML ='<img src="images/user-logo.png" onclick="loggedinfo()">';
                    fetch('fetchusername.php')
                        .then(res=>res.json())
                        .then(data =>{
                            if(data.success){
                                document.querySelector(".logininfo").innerHTML = "Hello, " + data.username;
                            }
                            else{
                                console.warn("usernot found");
                                
                            }
                        })
                    setTimeout(()=>{
                        document.querySelector(".logininfocontainer").innerHTML="";
                    },1000)
                    const userId = `<?php echo $id;?>`;

                    
                }
            })
        }
        results = JSON.parse(`<?php echo json_encode($total_data)?>`);
        console.log(results);
        for(i=0;i<results.n;i++){
            const today = new Date();
            const targetDate = new Date(results.data[i]['last_date']); // example future date

            const timeDiff = targetDate - today; // in milliseconds
            const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // convert to days
            document.querySelector(".details_body_bottom").innerHTML+=`
            <div class="event-1 event-details">
                <div class="event-cover-pic">
                    <div class="event-pic"></div>
                </div>
                <div class="event-info">
                    <div class="event-name">${results.data[i]['event_name']}</div>
                    <div class="event-place">${results.data[i]['state']}</div>
                    <div class="event-time-left">${daysLeft} days left</div>
                </div>
            </div>
            `
        }
    </script>
</body>
</html>