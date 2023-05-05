<?php

// Send back to index.php if they're not logged in
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quiz Browser</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="topnav">
            <a href="account.php">Account</a>
            <a href="my_quizzes.php">My Quizzes</a>
            <a class="active">Browse Quizzes</a>
            <a href="./model/logout_db.php">Logout</a>
        </div>
        <h2>Browse for Quizzes:</h2>
    </body>
</html>