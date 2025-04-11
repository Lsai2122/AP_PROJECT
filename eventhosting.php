<?php
    
    session_start();
    $uri = $_SERVER['REQUEST_URI'];
    $path = parse_url($uri, PHP_URL_PATH);
    $normalizedPath = rtrim($path, '/');
    
    if (strpos(strtoupper($normalizedPath), "EVENT")!=false){

        include('pages/eventhostingpage.php');
        

    } else {
        echo $normalizedPath;
    }

    
?>