<?php
    
    session_start();

    $uri = $_SERVER['REQUEST_URI'];
    $path = parse_url($uri, PHP_URL_PATH);
    $normalizedPath = rtrim($path, '/');
    
    if (strpos(strtoupper($normalizedPath), "AP_PROJECT")!=false){

        include('pages/mainpage.php');
        

    } else {
        echo $normalizedPath;
    }

    
?>