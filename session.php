<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SESSION['user-id'] == -1) {
    echo '-1';
} else {
    echo '1';
}
