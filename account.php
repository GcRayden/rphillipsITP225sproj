<?php

// Empty variable
$name = "";

// Send user to index.php if they're not logged in
// Otherwise, show their name or username
// Depends if they created an account with a name
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
} else {
    if (isset($_COOKIE['firstname']))
        $name = $_COOKIE['firstname'];
    else
        $name = $_COOKIE['username'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Account Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="topnav">
            <a class="active">Account</a>
            <a href="my_quizzes.php">My Quizzes</a>
            <a href="quiz_browser">Browse Quizzes</a>
            <a href="./models/logout_db.php">Logout</a>
        </div>
        <h2>Welcome <?php echo $name ?>!</h2>
    </body>
</html>