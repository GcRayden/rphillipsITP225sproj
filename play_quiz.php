<?php

include './includes/header.php';
include './includes/top_navbar.php';
include './models/quiz_db.php';

function printQuizData($quizID)
{
    $questions = getQuizQuestions($quizID);

    // Put all answers into a string with @@@ to separate the variables
    $answers = getQuizAnswers($quizID);

    // Have clean arrays
    $parsedQ = array();
    $parsedA = array();

    // Go through every question and separate into an answer array, removing the @@@
    $separator = '@@@';
    $outputQ = explode($separator, $questions);
    foreach ($outputQ as $i) {
        $parsedQ[] = $i;       
    }

    // Go through every question and separate into an answer array, removing the @@@
    $separator = '@@@';
    $outputA = explode($separator, $answers);
    foreach ($outputA as $i) {
        $parsedA[] = $i;       
    }

    $count = 0;
    for ($row = 0; $row < count($parsedQ); $row++) {
        echo "<br/><br/><h2><b>" . $parsedQ[$row] . "</b></h2>";
        for ($col = $count; $col < ($count + 4); $col++) {
            echo "<h3>" . $col . "</h3>";
            echo "<h3><input type='radio' id='" . $row . "' name='" . $row . "'>" . $parsedA[$col] . "</h3>";
        }
        $count += 4;
    }
}

?>
    <h2>Pick the correct answer:</h2>
    <?php printQuizData($_GET['quiz']); ?>
    <br/><br/><button class="quizSubmit" type="submit" name="submitButton">Submit Quiz</button>

<h2>
    <?php echo $message ?>
</h2>
<?php include './includes/footer.php'; ?>