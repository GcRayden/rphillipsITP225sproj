<?php

include './models/quiz_db.php';

function printQuizData($quizID)
{

    $questions = implode("@@@", getQuizQuestions($quizID));
    $answers = implode ("@@@", getQuizAnswers($quizID));
    $separator = '@@@';

    $parsedQ = array();
    $parsedA = array();

    $outputQ = explode($separator, $questions);
    foreach ($outputQ as $i) {
        $parsedA = $i;       
    }

    $outputA = explode($separator, $answers);
    foreach ($outputA as $i) {
        $parsedA = $i;       
    }

    for ($row = 0; $row < count($parsedQ); $row++) {
        echo "<h2><b>" . $parsedQ[$row] . "</b></h2>";
        echo "<ul>";
        for ($col = 0; $col < 4; $col++) {
            echo "<li>" . $answers[$col] . "</li>";
        }
        echo "</ul>";
    }
}

?>

<?php include './includes/header.php';?>
    <?php include './includes/top_navbar.php';?>
    <h2>Pick the correct answer:</h2>
    <?php printQuizData(1); ?>
<form method="post">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="form-control" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" required>
        <button type="submit" name="submitButton">Login</button>
    </div>
</form>

<h3>Don't have an account? <a href="create_account.php">Create one here!</a></h3>

<h2>
    <?php echo $message ?>
</h2>
<?php include './includes/footer.php'; ?>