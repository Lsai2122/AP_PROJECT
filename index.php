<?php

    session_start();
    $_SESSION['user-id']=-1;
    $uri = $_SERVER['REQUEST_URI'];
    $path = parse_url($uri, PHP_URL_PATH);
    $normalizedPath = rtrim($path, '/');
    
    if (strpos(strtolower($normalizedPath), 'ap_project') !== false) {

        include('pages/mainpage.php');

    } else {
        echo  $normalizedPath;
    }

    
?>