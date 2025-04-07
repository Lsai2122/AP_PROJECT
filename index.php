<?php
    $uri = $_SERVER['REQUEST_URI'];
    $path = parse_url($uri, PHP_URL_PATH);
    $normalizedPath = rtrim($path, '/');
    
    if($normalizedPath === '/AP_Project/index.php' || $normalizedPath === '' || $normalizedPath === 'index.php') {
        include('pages/mainpage.php');
    }
    else{
        echo "bye";
    }
    
?>