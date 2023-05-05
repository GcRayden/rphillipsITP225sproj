<?php

// Send back to index.php if they're not logged in
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Quizzes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="topnav">
            <a href="account.php">Account</a>
            <a class="active">My Quizzes</a>
            <a href="quiz_browser.php">Browse Quizzes</a>
            <a href="./models/logout_db.php">Logout</a>
        </div>
        <h2>My Quizzes:</h2>
    </body>
</html>