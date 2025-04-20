<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/styles/header.css">
</head>
<body>
    <header class="head-header">
        <div class="head-left">
            <div class="head-logo" onclick="window.location.href='index.php'">
                <img src="images/logo.png" alt="Logo" class="head-logo-image">
                <p class="head-logo-text">Eventora</p>
            </div>
        </div>
        <div class="head-mid">
            <div class="head-new" onclick="window.location.href=`searchresults.php?search=new`">
                New
                <div class="head-vertical-line"></div>
            </div>
            <div class="head-upcoming" onclick="window.location.href=`searchresults.php?search=upcoming`">
                Upcoming<br>Events
                <div class="head-vertical-line"></div>
            </div>
            <div class="head-best-hosts" onclick="window.location.href=`searchresults.php?search=best`">
                Best Hosts
                <div class="head-vertical-line"></div>
            </div>
            <div class="head-best-events" onclick="window.location.href=`searchresults.php?search=best`">
                Best Events
                <div class="head-vertical-line"></div>
            </div>
            <div class="head-applied" onclick="window.location.href=`searchresults.php?search=hosted`">
                Hosted
                <div class="head-vertical-line"></div>
            </div>
        </div>
        <div class="head-right">
            <div class="head-search-bar">
                <div class="head-search-icon">
                    <img src="images/search1.png" alt="Search Icon" class="head-search-image">
                </div>
                <form action="searchresultsphp" method="get">
                <input type="search " placeholder="Search Events" class="head-search-input">
                </form>
            </div>
            <div class="head-vertical-line"></div>
            <div class="head-login" >
                
            </div>
            <div class="head-vertical-line"></div>
            <div class="head-host-button" onclick="window.location.href='eventhosting.php'">
                <img src="images/plus1.png" alt="Host Icon" class="head-host-image">
                Host
            </div>
        </div>
    </header>
    <div class="logininfocontainer">
    <div class="logininfo"></div>
    </div>
    <div class="loggedinfo">
        
    </div>

    <script  src="pages/scripts/header.js"></script>
</body>
</html>