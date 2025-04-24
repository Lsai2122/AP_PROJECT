<?php
    session_start();
    include('pages/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="pages/styles/eventhostingpage.css">
    <title>Document</title>
</head>
<body >
    <div class="form_out">
        <div class="gap"></div>
        <div class="form_body">
            <div class="body_top">
                <p>Host a Event</p>
            </div>
            <div class="eventform">
                
</div>
        </div>
        <div class="gap"></div>
    </div>
    <div class="logininfocontainer">
        <div class="logininfo"></div>
    </div>
    <div class="login-into"></div>
    <div class="login-info-container">
    <script>
        function checklogin(){
            fetch("session.php")
            .then(res => res.text())
            .then(html => {
                if(html=='-1'){
                    document.querySelector(".head-login").innerHTML = '<button class="head-login-button" onclick="LoginDisplay()">Login</button>';
                    document.querySelector(".logininfo").innerHTML = 'not signed in'
                    document.querySelector(".eventform").innerHTML=`<button class="head-login-button" onclick="LoginDisplay()">Login</button> to host a event`;
                }
                else{
                    document.querySelector(".head-login").innerHTML ='<img src="images/user-logo.png" onclick="loggedinfo()">';
                    fetch('fetchusername.php')
                        .then(res=>res.json())
                        .then(data =>{
                            document.querySelector(".logininfo").innerHTML = "Hello, " + data.username;
                        })
                    setTimeout(()=>{
                        document.querySelector(".logininfocontainer").innerHTML="";
                    },1000)
                    document.querySelector(".eventform").innerHTML=`<?php include "pages/eventform.php"?>`
                    document.querySelector(".eventhoster").addEventListener("submit", function(e) {
                        e.preventDefault();

                        fetch("eventfilling.php", {
                            method: "POST",
                            body: new FormData(this)
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                alert("Event submitted successfully!");
                            } else {
                                console.error(data.message);
                                alert("Error: " + data.message);
                            }
                        })
                        .catch(err => {
                            console.error("Fetch error:", err);
                            alert("Something went wrong!");
                        });
                    });

                }
                                })
            .catch(err => console.error("Error loading session:", err));
        }
        function roundsDisplay() {
        numberOfRounds(document.getElementById("rounds").value);
        console.log("Done");
    }
    </script>
    <script src="pages/scripts/eventhosting.js"></script>
</body>
</html>