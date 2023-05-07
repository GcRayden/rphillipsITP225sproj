<?php

include './includes/header.php';
include './includes/top_navbar.php';
include './models/quiz_db.php';

$message = "";

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
    $answerCount = 0;
    $answerKey = array();
    $separator = '@@@';
    $outputA = explode($separator, $answers);
    foreach ($outputA as $i) {
        $parsedA[] = $i;
        if ($answerCount % 4 == 0) {
            $answerKey[] = $i;
        }
    }

    $rand = array();
    for ($row = 0; $row < count($parsedQ); $row++) {
        echo "<br/><br/><h2><b>" . $parsedQ[$row] . "</b></h2>";

        // Get slice of 4 elements starting from current index
        $slice = array_slice($parsedA, $row * 4, 4);

        // Add slice to $rand array
        $rand[] = $slice;

        // Shuffle the slice
        shuffle($rand[$row]);

        // Put it on the page
        for ($col = 0; $col < 4; $col++) {
            $checked = '';
            $class = '';
            if (isset($_POST[$row]) && $_POST[$row] == $rand[$row][$col]) {
                $checked = 'checked';
                if ($rand[$row][$col] == $answerKey[$row]) {
                    $class = 'correct-answer';
                } else {
                    $class = 'wrong-answer';
                }
            }
            echo "<h3><input type='radio' id='" . $row . "' name='" . $row . "' value='" . $rand[$row][$col] . "' $checked><span class='$class'>" . $rand[$row][$col] . "</span></h3>";
        }
    }

    if (isset($_POST['submitButton'])) {
        $score = 0;
        for ($row = 0; $row < count($parsedQ); $row++) {
            if (isset($_POST[$row])) {
                $selectedAnswer = $_POST[$row];
                $correctAnswer = $answerKey[$row];
                if ($selectedAnswer == $correctAnswer) {
                    $score++;
                }
            }
        }
        global $message;
        $message = "Your score is: " . $score . "/" . count($parsedQ);
    }
}

?>

<br/><br/>
<form method="POST" action="">
    <h2>Pick the correct answer:</h2>
    <?php printQuizData($_GET['quiz']); ?>
    <br/><br/>
    <button class="quizSubmit" type="submit" name="submitButton">Submit Quiz</button>
</form>

<h2>
    <?php echo $message ?>
</h2>
<?php include './includes/footer.php'; ?>