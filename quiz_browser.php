<?php

// Send back to index.php if they're not logged in
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}
?>

<?php include './includes/header.php';?>
<body>
    <div class="topnav">
        <a href="account.php">Account</a>
        <a href="my_quizzes.php">My Quizzes</a>
        <a class="active">Browse Quizzes</a>
        <a href="./models/logout_db.php">Logout</a>
    </div>
    <h2>Browse for Quizzes:</h2>
</body>
<?php include './includes/footer.php';?>