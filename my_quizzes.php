<?php

// Send back to index.php if they're not logged in
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}
?>

<?php include './includes/header.php';?>
    <?php include './includes/top_navbar.php';?>
    <button class="createQuiz">Create New Quiz</button><br/><br/>
    <h2>My Quizzes:</h2><br/><br/>
    <?php include './models/search_db.php'; ?>
    <?php getQuizzes($_COOKIE['memberid']); ?>
<?php include './includes/footer.php';?>