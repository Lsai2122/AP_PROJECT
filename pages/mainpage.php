<?php
    include('pages/header.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossori123456gin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pages/styles/mainpage.css">
    <link rel="website icon" href="images/logo.png" type="png">
</head>
<body  onload="checklogin()">
    <div class="main">
            <div class="left">
            <div class="left-content">
                <div class="left-upper">
                    <img src="images/mic.png" class="mic-img">
                    <div class="mic">Host a <br> Event</div><br>
                </div>
                <div class="horizontal-left"></div>
                <Button class="buttton-host">Host</Button>
            </div>
        </div>
        <div class="right">
            <div class="right-content">
                <button class="button-join"><div >Join</div></button>
                <div class="horizontal-right"></div>
                <div class="right-bottom">
                    <div class="compu">Join a <br> Event </div>
                    <img src="images/computer.png" class="computer">
                </div>
            </div>
        </div>
    </div>
    <div class="page2">
        <div class="section-1">
            <div class="New">
                New
                <div class="underline"></div>
            </div>
            <div class="normal-event">
                <div class="arrow">
                    <img src="images/arrow-left.png" id="normal-prev">
                </div>
                <div class="event-view-box">
                    <div class="NewEvent">
                        
                    </div>
                </div>
                <div class="arrow">
                    <img src="images/arrow-right.png" id="normal-next">
                </div>
            </div>
        </div>
        <div class="section-2">
            <div class="best_events">
                Best Events
                <div class="underline-best"></div>
            </div>
            <div class="best_event">
                <div class="arrow">
                    <img src="images/arrow-left.png" id="best-prev">
                </div>
                <div class="best-event-view-box">
                    <div class="best-event"></div>
                </div>
                <div class="arrow">
                    <img src="images/arrow-right.png" id="best-next">
                </div>
            </div>
        </div>
        <div class="section-3"></div>
    </div>
    <div class="login-into"></div>
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
                        document.querySelector(".section-3").innerHTML=`<?php include "pages/joined_events.php"?>`
                        const userId = <?php echo $id;?>; // Example user_id

                        fetch('fetcheventsjoined.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `user_id=${userId}`
                        })
                        .then(response => response.json())
                        .then(res => {
                            if (data.error) {
                                console.error('Error:', data.error);
                            } else {
                                data = res.data;
                                n=res.n;
                                for(i=0;i<res.n;i++){
                                    id = data[i].id;
                                    fetch('fetcheventdetails.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: `event_id=${id}`
                                    })
                                    .then(response => response.json())
                                    .then(data2 => {
                                        if (data2.error) {
                                        console.log('Error:', data2.error);
                                        } else {
                                            data2 = data2.data
                                            console.log(data2)
                                            link = `window.location.href='eventdetailspage.php?event_id=${data2['id']}`
                                            document.querySelector(".applied-event-box").innerHTML += `
                                                <div class="event-${i} applied-event-details" onclick="window.location.href='eventdetailspage.php?event_id=${data2['id']}'">
                                                    <div class="applied-event-cover-pic">
                                                        <div class="applied-event-pic"></div>
                                                    </div>
                                                    <div class="applied-event-info">
                                                        <div class="applied-event-name">${data2.event_name}</div>
                                                        <div class="applied-event-place">${data2.state}</div>
                                                    </div>
                                                    <div class="round-1">
                                                        <p class="round">
                                                            Round 1: <span>${data2['round1']?.[0]?.round_name || 'N/A'}</span>
                                                        </p>
                                                        <div class="rounds-info">
                                                            <div class="information">
                                                                Date: ${data2['round1']?.[0]?.date || 'N/A'}
                                                            </div>
                                                            <div class="information">
                                                                Time: ${data2['round1']?.[0]?.time || 'N/A'}
                                                            </div>
                                                            <div class="information">
                                                                Details: ${data2['round1']?.[0]?.details || 'N/A'}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="round-2">
                                                        <p class="round">
                                                            Round 2: <span>${data2['round2']?.[0]?.round_name || 'N/A'}</span>
                                                        </p>
                                                        <div class="rounds-info">
                                                            <div class="information">
                                                                Date: ${data2['round2']?.[0]?.date || 'N/A'}
                                                            </div>
                                                            <div class="information">
                                                                Time: ${data2['round2']?.[0]?.time || 'N/A'}
                                                            </div>
                                                            <div class="information">
                                                                Details: ${data2['round2']?.[0]?.details || 'N/A'}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;

                                        }
                                    })
                                    

                                }
                                
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                })
                .catch(err => console.error("Error loading session:", err));
            }
            {fetch("last_five.php")
            .then(response => response.json())
            .then(result => {
                n = result.n;
                data = result.data;
                for(i=0;i<n;i++){
                    const today = new Date();
                    const targetDate = new Date(data[i]['last_date']); // example future date

                    const timeDiff = targetDate - today; // in milliseconds
                    const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // convert to days
                    document.querySelector(".NewEvent").innerHTML+=`
                    <div class="event-${i+1} event-details" onclick="window.location.href='eventdetailspage.php?event_id=${data[i]['id']}'">
                        <div class="event-cover-pic">
                            <div class="event-pic"></div>
                        </div>
                        <div class="event-info">
                            <div class="event-name">${data[i]['event_name']}</div>
                            <div class="event-place">${data[i]['state']}</div>
                            <div class="event-time-left">${daysLeft} days left</div>
                        </div>
                    </div>
                    `
                }
                
            })
            .catch(error => {
                console.error("Error fetching data:", error);
            });
            }


            {fetch('fetchbest.php')
            .then(response=>response.json())
            .then(result=>{
                n=result.n;
                data = result.data
                for(i=0;i<n;i++){
                    eventId=data[i].id;
                    fetch('fetcheventdetails.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `event_id=${eventId}`
                    })
                    .then(response => response.json())
                    .then(data2 => {
                        if (data2.error) {
                        console.log('Error:', data2.error);
                        } else {
                            data2 = data2.data
                            const today = new Date();
                            const targetDate = new Date(data2['last_date']); // example future date

                            const timeDiff = targetDate - today; // in milliseconds
                            const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // convert to days
                            document.querySelector('.best-event').innerHTML += `
                                <div class="event-${i + 1} best-event-details" onclick="window.location.href='eventdetailspage.php?event_id=${data2['id']}'">
                                    <div class="best-event-cover-pic">
                                        <div class="best-event-pic"></div>
                                    </div>
                                    <div class="best-event-info">
                                        <div class="best-event-name">${data2['event_name']}</div>
                                        <div class="best-event-place">${data2['state']}</div>
                                        <div class="best-event-time-left">${daysLeft} days left</div>
                                    </div>
                                </div>
                            `;

                        // You can display the event data in your UI
                        }
                    })
                    .catch(error => console.error('Error:', error));
                    
                }
            })
            }




</script>
    <script type="module" src="pages/scripts/mainpage.js"></script>
    <script src="pages/scripts/header.js"></script>
</body>
</html>