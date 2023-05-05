<div class="title">
    <h1> Robert's Quiz Website! </h1>
</div>
<div class="topnav">
    <a href="account.php" <?php if(basename($_SERVER['PHP_SELF']) == 'account.php') echo 'active'; ?>">Account</a>
    <a href="my_quizzes.php <?php if(basename($_SERVER['PHP_SELF']) == 'my_quizzes.php') echo 'active'; ?>"">My Quizzes</a>
    <a href="quiz_browser.php <?php if(basename($_SERVER['PHP_SELF']) == 'quiz_browser.php') echo 'active'; ?>"">Browse Quizzes</a>
    <a href="./models/logout_db.php">Logout</a>
</div>