<?php
    include 'pages/header.php'; 
    
    $conn = new mysqli("localhost", "root", "", "ap_project");

    $id = (int)$_GET["event_id"];

    if (!$id || !is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid or missing event_id']);
        exit();
    }
    
    // Query to count users joined in the event
    $stmt = $conn->prepare("SELECT COUNT(*) FROM joined WHERE event_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    $joinedcount= json_encode([
        'success' => true,
        'event_id' => $id,
        'joined_count' => $count
    ]);
    
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed']);
        exit();
    }

    $sql = "SELECT * FROM event_main_details WHERE id = $id";
    $result = $conn->query($sql);

    $data = [];
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $data[]=$row;
        }
    }
    $rounds = [];
    for($i=1;$i<=$data[0]['rounds'];$i++){
        $sql = "SELECT * FROM round$i WHERE eventid = $id";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $rounds[]=$row;
            }
        }
    }
    $joined=-1;
    $user = $_SESSION['user-id'];
    $sql = "SELECT * FROM joined WHERE event_id=$id AND user_id=$user";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        $joined=1;
    }

    if($joined == 1) {
        $stmt = $conn->prepare("SELECT j.*, m.*
                                FROM members m
                                JOIN joined j ON m.joined_id = j.joined_id
                                WHERE j.event_id = ? AND j.user_id = ?");
        $stmt->bind_param("ii", $id, $user);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $joined_users = [];
        
        while ($row = $result->fetch_assoc()) {
            $joined_users[] = $row;
        }
    }
    else{
        $k = ['failed'];
        $joined_users=[];
        $joined_users[]=$k;
    }
    
    
        $conn->close();

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
    <link rel="stylesheet" href="pages/styles/Eventdetails.css">
</head>

<body onload="checklogin()">
    <div class="main">
        <div class="host-main">
            <div class="vertical-line1"></div>
            <div class="details">
                <div class="event-name">
                    
                </div>
                <div>
                    <div class="details-gap"></div>
                    <div class="location">
                        <img src=" images/location.png" alt="Location Icon" class="location-icon">
                        <p class="location-text"></p>
                    </div>
                    <div class="date">
                        <img src=" images/calendar.png" alt="Calendar Icon" class="date-icon">
                        <p class="date-text"></p>
                    </div>

                </div>
            </div>
            <div class="days-left">
                <div class="days-container">
                    <div class="days-number"></div>
                    <div class="days-text"><span style="opacity: 0.54;">Days Left</span></div>
                </div>
            </div>
            <div class="register">
               
            </div>
        </div>
        <div class="stages">
            <div class="stages-head">
                <p>Stages & Timings</p>
                <div style="flex: 1;"></div>
                
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
                        count = JSON.parse(`<?php echo $joinedcount;?>`);
                        document.querySelector(".head-login").innerHTML = '<button class="head-login-button" onclick="LoginDisplay()">Login</button>';
                        document.querySelector(".logininfo").innerHTML = 'not signed in'
                        document.querySelector(".register").innerHTML=` <div class="register-container">
                                <div class="register-details">
                                    <div class="event-logo">
                                        <img src=" images/eventimg.png" alt="Event Logo" class="event-logo-image">
                                    </div>
                                    <div class="event-description">
                                        <div class="team-size">
                                            <div class="team-img">
                                                <img src=" images/team.png">
                                            </div>
                                            <div class="team-info">
                                                <div class="team-size-text">Team Size</div>
                                                <div class="team-size-data">1-4 Members</div>
                                            </div>
                                        </div>
                                        <div class="teams-joined">
                                            <div class="teams-img">
                                                <img src=" images/teams.png">
                                            </div>
                                            <div class="teams-info">
                                                <div class="teams-size-text">Teams Joined</div>
                                                <div class="teams-size-data">${count.joined_count}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="reg-but">
                                    <button class="reg-button" onclick="window.location.href = 'eventreg.php?event_id=<?php echo $id;?>'">Register</button>
                                </div>
                            </div>`
                        document.querySelector(".team-size-data").innerHTML = `1-${MaxMem} Members`
                    }
                    else{
                        count = JSON.parse(`<?php echo $joinedcount;?>`);
                        document.querySelector(".head-login").innerHTML ='<img src="images/user-logo.png" onclick="loggedinfo()">';
                        fetch('fetchusername.php')
                            .then(res=>res.json())
                            .then(data =>{
                                document.querySelector(".logininfo").innerHTML = "Hello, " + data.username;
                            })
                        setTimeout(()=>{
                            document.querySelector(".logininfocontainer").innerHTML="";
                        },1000)
                        joined = <?php echo $joined;?>;
                        if(joined==-1){
                            document.querySelector(".register").innerHTML=` <div class="register-container">
                                <div class="register-details">
                                    <div class="event-logo">
                                        <img src=" images/eventimg.png" alt="Event Logo" class="event-logo-image">
                                    </div>
                                    <div class="event-description">
                                        <div class="team-size">
                                            <div class="team-img">
                                                <img src=" images/team.png">
                                            </div>
                                            <div class="team-info">
                                                <div class="team-size-text">Team Size</div>
                                                <div class="team-size-data">1-4 Members</div>
                                            </div>
                                        </div>
                                        <div class="teams-joined">
                                            <div class="teams-img">
                                                <img src=" images/teams.png">
                                            </div>
                                            <div class="teams-info">
                                                <div class="teams-size-text">Teams Joined</div>
                                                <div class="teams-size-data">${count.joined_count}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="reg-but">
                                    <button class="reg-button" onclick="window.location.href = 'eventreg.php?event_id=<?php echo $id;?>'">Register</button>
                                </div>
                            </div>`
                            document.querySelector(".team-size-data").innerHTML = `1-${MaxMem} Members`
                        }
                        else{
                            const res = <?php echo json_encode($joined_users[0]); ?>;
                            console.log("sadfv")
                            console.log(res)
                            document.querySelector(".register").innerHTML=`<div class="register-container">
                                <div class="leader_name">
                                </div>
                                <div class="lead_mem_details">
                                    <div class="details-gap"></div>
                                    <div class="leader_details">
                                        <div class="det">
                                        <span class="mm_name">Lead Name:- </span><span>${res['LeadName']}</span>
                                        </div>
                                        <div class="det">
                                        <span class="mm_name">Email:-</span><span>${res['LeadEmail']}</span>
                                        </div>
                                        <div class="det">
                                        <span class="mm_name">Contact:-</span><span>${res['LeadNum']}</span>
                                        </div>

                                    </div>
                                    <div class="details-gap"></div>
                                </div>
                                </div>`
                                setTimeout(()=>{
                                    for(i=1;i<=res['FilledMembers'];i++){
                                    console.log(res[`Mem${i}`])
                                    document.querySelector(".leader_details").innerHTML+=`
                                        <div class="det">
                                        <span class="mm_name">Member ${i} Name:-</span><span>${res[`Mem${i}`]}</span>
                                        </div>
                                    `
                                }
                                },10)
                                
                        }
                    }
                                    })
            }
            const EventDetails = <?php echo json_encode($data[0]); ?>;
            const rounds = <?php echo json_encode($rounds);?>;


            console.log(EventDetails);
            console.log(rounds);


            event=EventDetails.event_name;
            state = EventDetails.state;
            date = new Date(EventDetails.last_date);
            MaxMem = EventDetails.max_members;
            norounds = EventDetails.rounds;
            const today = new Date();
            const targetDate = date;
            const timeDiff = targetDate - today;
            const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

            document.querySelector(".event-name").innerHTML=`
                                        ${event}
                                        <div class="horizontal-line"></div>
                                        `;
            document.querySelector(".location-text").innerHTML = state;
            document.querySelector(".date-text").innerHTML=`Last Date: ${date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}`;
            document.querySelector(".days-number").innerHTML=daysLeft;
            

            for(i=1;i<=norounds;i++){
                rtime = rounds[i-1]['time']
                time = new Date("1970-01-01T"+ rtime);
                newtime = new Date(time);
                newtime.setHours(newtime.getHours()+rounds[i-1]['duration'])
                newtime =(newtime).toTimeString().slice(0,5);
                time = time.toTimeString().slice(0,5);
                rdate = new Date(rounds[i-1]['date'])
                rdaysLeft= Math.ceil((rdate-today)/(1000*60*60*24));
                console.log(time);
            document.querySelector(".stages-head").innerHTML+= `<div class="round">
                        <div class="round-text">Round ${i}: <span style="font-weight: normal;">${rounds[i-1]["round_name"]}</span></div>
                        <div class="round-details">
                            <div class="days-container1">
                                <div class="days-number">${rdaysLeft}</div>
                                <div class="days-text"><span style="opacity: 0.54;">Days Left</span></div>
                            </div>
                            <div class="date-and-time">
                                <div class="round-details-given">${rounds[i-1]["details"]}<br>
                                </div>
                                <div class="round-date">Date: ${rounds[i-1]["date"]}</div>
                                <div class="round-time">Time: ${time}-${newtime}</div>
                            </div>
                        </div>
                    </div>`
            }
        </script>
</body>

</html>