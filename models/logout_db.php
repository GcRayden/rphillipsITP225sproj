<?php
    // If they somehow manage to get on this page while logged out, send them away
    if (!isset($_COOKIE['username'])) {
        header('Location: index.php');
    } else {
        session_start();
    }

    // If cookie still exists, then get rid of it and send user to index.php
    if (isset($_COOKIE['username']))
    {
        unset($_COOKIE['username']);
        unset($_COOKIE['password']);
        unset($_COOKIE['firstname']);
        setcookie('username', '', time() - 3600, "/"); 
        setcookie('password', '', time() - 3600, "/"); 
        setcookie('firstname', '', time() - 3600, "/");
    }
    header('Location: ../index.php');
?>