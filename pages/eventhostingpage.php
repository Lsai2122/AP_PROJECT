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
<body onload="checklogin()">
    <div class="form_out">
        <div class="gap"></div>
        <div class="form_body">
            <div class="body_top">
                <p>Host a Event</p>
            </div>
            <div class="form_body_main">
                
            </div>
        </div>
        <div class="gap"></div>
    </div>
    <script>
        function checklogin(){
            fetch("session.php")
            .then(res => res.text())
            .then(html => {
                if(html=='-1'){
                    document.querySelector(".head-login").innerHTML = '<button class="head-login-button" onclick="LoginDisplay()">Login</button>';
                    document.querySelector(".logininfo").innerHTML = 'not signed in'
                    document.querySelector(".form_body_main").innerHTML=`<button class="head-login-button" onclick="LoginDisplay()">Login</button> to host a event`;
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
                    document.querySelector(".form_body_main").innerHTML=`<?php include "pages/eventform.php"?>`
                }
            })
            .catch(err => console.error("Error loading session:", err));
        }
        
    </script>
</body>
</html>