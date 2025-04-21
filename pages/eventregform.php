<?php
    $id = $_GET["event_id"];

    // Connect to DB
    $conn = new mysqli("localhost", "root", "", "ap_project");

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
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <title>Eventora</title>
    <link rel="stylesheet" href="pages/styles/eventparticipate.css">
</head>
<body onload="checklogin()">
    <script>
        const EventDetails = JSON.parse(`<?php echo json_encode($data);?>`)[0];
        let totalMembers= EventDetails.max_members-1;
        current=1;
    </script>
    <div class="main-page">
        <div class="event-info-box">
            <div class="border-line"></div>
            <div class="event-content">
                <div class="event-info">
                    <div class="event-details">
                        <h2 class="event-name">Blast Hackthon</h2>
                        <div class="loc">
                            <img src="images/location.png" class="loc-img">
                            <span class="loc-name">Uttar Pradesh</span>
                        </div>
                        <div class="last-date">
                            <img src="images/calendar.png">
                            <span class="date">Last Date: 19-Mar-2025</span>
                        </div>
                    </div>
                    <div class="event-pic"></div>
                </div>
                <div class="days-left">
                    <div class="number">10</div>
                    <div class="left">Days Left</div>
                </div>
            </div>
        </div>
        <form class="event-form">
           
        </form>
    </div>
    <div class="logininfocontainer">
        <div class="logininfo"></div>
    </div>
    <div class="login-into"></div>
    <div class="login-info-container">
    <script src="pages/scripts/eventparticipate.js"></script>
    <script>
        function checklogin(){
            fetch("session.php")
            .then(res => res.text())
            .then(html => {
                if(html=='-1'){
                    document.querySelector(".head-login").innerHTML = '<button class="head-login-button" onclick="LoginDisplay()">Login</button>';
                    document.querySelector(".logininfo").innerHTML = 'not signed in'
                    document.querySelector(".event-form").innerHTML=`<button class="head-login-button" onclick="LoginDisplay()">Login</button> to proceed`
                }
                else{
                    document.querySelector('.event-form').innerHTML=`
                     <div class="team-name-box">
                        <label for="team-name" class="team-name">Team Name: </label>
                        <input type="text" name="team-name" id="team-name" class="team-input-name" placeholder="Name" size="35" required>
                    </div>
                    <div class="team-leader-box">
                        <label for="lead-name" class="lead-name">Team Leader: </label>
                        <div class="lead-details">
                            <div class="name-college-gender">
                                <input type="text" name="lead-name" id="lead-name" class="lead-name-input" placeholder="Name" size="30" required><br>
                                <input type="text" name="lead-college" id="lead-college" class="lead-college" placeholder="College" size="30" required><br>
                                <div class="lead-gender">
                                    <div class="sex">Gender:</div>
                                    <div class="male">
                                        <input type="radio" name="lead-gender" id="male" class="input-male" value="male" required>
                                        <label for="male" class="lead-male">Male</label>
                                    </div>
                                    <div class="female"> 
                                        <input type="radio" name="lead-gender" id="input-female" class="female" value="female">
                                        <label for="female" class="lead-female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="email-number-button">        
                                <input type="email" name="lead-email" id="lead-email" class="lead-email" placeholder="Email" size="30" required><br>
                                <input type="tel" name="lead-number" id="lead-number" class="lead-number" placeholder="Phone Number" size="30" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="team-members-box">
                    </div>
                    <div class="button">
                        <input type="button" name="add-member" id="add-member" class="add-member" onclick='add()' value="Add a Member">
                        <input type="reset" name="remove" id="remove" class="remove" value="Remove" onclick="remove();">
                    </div>
                    <input type="submit" name="submit" id="submit" class="submit">
                    `
                    document.querySelector(".event-form").addEventListener("submit",function(e){
                        formdata = new FormData(this);
                        formdata.append('current',current);
                        formdata.append("event_id",<?php echo $id?>);
                        fetch("eventjoinedfiller.php",{
                                method:"POST",
                                body: formdata
                        })
                        .then(res=>res.json())
                        .then(data=>{
                            if(data.success){
                                alert("Joined Successfully")
                            }else{
                                alert(data.message);
                            }
                        })
                        .catch(err=>{
                            console.error(err);
                            alert("something went wrong");
                        })
                    })
                    document.querySelector(".head-login").innerHTML ='<img src="images/user-logo.png" onclick="loggedinfo()">';
                    fetch('fetchusername.php')
                        .then(res=>res.json())
                        .then(data =>{
                            document.querySelector(".logininfo").innerHTML = "Hello, " + data.username;
                        })
                    setTimeout(()=>{
                        document.querySelector(".logininfocontainer").innerHTML="";
                    },1000)
                }
                                })
            .catch(err => console.error("Error loading session:", err));
        }
        document.querySelector(".event-form").addEventListener("submit",function(e){
            e.preventDefault();
            
        })

        event=EventDetails.event_name;
        state = EventDetails.state;
        date = new Date(EventDetails.last_date);
        MaxMem = EventDetails.max_members;
        norounds = EventDetails.rounds;
        const today = new Date();
        const targetDate = date; // example future date
        const timeDiff = targetDate - today; // in milliseconds
        const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // convert to days
        document.querySelector(".event-name").innerHTML = EventDetails.event_name;
        document.querySelector(".loc-name").innerHTML=EventDetails.state;
        document.querySelector(".date").innerHTML= `Last Date: ${date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}`
        document.querySelector(".number").innerHTML=daysLeft;
    </script>
</body>
</html>