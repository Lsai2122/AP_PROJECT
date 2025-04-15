<?php
    include 'pages/header.php'; 
    
    

    $id = $_GET["event_id"];

    // Connect to DB
    $conn = new mysqli("localhost", "root", "", "ap_project");

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed']);
        exit();
    }

    $sql = "SELECT * FROM event_main_details WHERE id = $id";
    $result = $conn->query($sql)

    if ($stmt->fetch()) {
        echo json_encode(['success' => true, 'username' => $username,'id'=>$_SESSION['user-id']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }

    $stmt->close();
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
                        <p class="location-text">Uttar Pradesh</p>
                    </div>
                    <div class="status">
                        <img src=" images/offline.png" alt="Clock Icon" class="status-icon">
                        <p class="status-text">Offline</p>
                    </div>
                    <div class="date">
                        <img src=" images/calendar.png" alt="Calendar Icon" class="date-icon">
                        <p class="date-text">Last Date: 12th March 2024</p>
                    </div>

                </div>
            </div>
            <div class="days-left">
                <div class="days-container">
                    <div class="days-number">12</div>
                    <div class="days-text"><span style="opacity: 0.54;">Days Left</span></div>
                </div>
            </div>
            <div class="register">
                <div class="register-container">
                    <div class="register-details">
                        <div class="event-logo">
                            <img src=" images/event.png" alt="Event Logo" class="event-logo-image">
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
                                    <div class="teams-size-data">200+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="reg-but">
                        <button class="reg-button">Register</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="stages">
            <div class="stages-head">
                <p>Stages & Timings</p>
                <div style="flex: 1;"></div>
                <div class="round1">
                    <div class="round1-text">Round 1: <span style="font-weight: normal;">Online Submission
                            Round</span></div>
                    <div class="round1-details">
                        <div class="days-container1">
                            <div class="days-number">12</div>
                            <div class="days-text"><span style="opacity: 0.54;">Days Left</span></div>
                        </div>
                        <div class="date-and-time">
                            <div class="round1-details-given">dasfhjgfghfdgfhydsacdggfcfvgrdcvfgtfdcxvfbghygf
                                dcvfdszaxcdfvgtrdszxdcfvgtfdcx
                                vfgfvcxdfrcv cdfgbv c<br>
                            </div>
                            <div class="round1-date">Date: 12th March 2024</div>
                            <div class="round1-time">Time: 10:00 AM - 12:00 PM</div>
                        </div>
                    </div>
                </div>
                <div class="round2">
                    <div class="round2-text">Round 1: <span style="font-weight: normal;">Online Submission
                            Round</span></div>
                    <div class="round2-details">
                        <div class="days-container1">
                            <div class="days-number">12</div>
                            <div class="days-text"><span style="opacity: 0.54;">Days Left</span></div>
                        </div>
                        <div class="date-and-time">
                            <div class="round2-details-given">dasfhjgfghfdgfhydsacdggfcfvgrdcvfgtfdcxvfbghygf
                                dcvfdszaxcdfvgtrdszxdcfvgtfdcx
                                vfgfvcxdfrcv cdfgbv c<br>
                            </div>
                            <div class="round2-date">Date: 12th March 2024</div>
                            <div class="round2-time">Time: 10:00 AM - 12:00 PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="information-div">
            <div class="information-head">
                Information
            </div>
            <div class="information-details-given">
                <div class="information-details-text">dasfhjgfghfdgfhydsacdggfcfvgrdcvfgtfdcxvfbghygf
                    dcvfdszaxcdfvgtrdszxdcfvgtfdcx
                    vfgfvcxdfrcv cdfgbv c<br><br>
                    dasfhjgfghfdgfhydsacdggfcfvgrdcvfgtfdcxvfbghygf
                </div>
                <div class="information-details-contact">
                    <div class="information-details-contact-div">
                        <div class="information-details-contact-text">Contact</div>
                        <div class="information-details-contact-details">
                            Name: Ajay Varma<br>
                            Email: ajay.varma@example.com<br>
                            Phone: +1234567890<br>
                        </div>
                    </div>
                </div>
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
                            document.querySelector(".head-login").innerHTML ='<img src="images/user-logo.png">';
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
                const params = new URLSearchParams(window.location.search);
                
                console.log(params.get('event_id'));

                event="nmaeasfa"
                event_name=document.querySelector(".event-name").innerHTML=`
                                            ${event}
                                            <div class="horizontal-line"></div>
                                            `
            </script>
</body>

</html>