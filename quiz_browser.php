<?php

// Send back to index.php if they're not logged in
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}
?>

<?php include './includes/header.php';?>
    <?php include './includes/top_navbar.php';?>
    <h2>Browse for Quizzes:</h2>
<?php include './includes/footer.php';?>