<?php

// Send back to index.php if they're not logged in
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}
?>

<?php include './includes/header.php';?>
<body>
    <?php include './includes/top_navbar.php';?>
    <h2>My Quizzes:</h2>
</body>
<?php include './includes/footer.php';?>