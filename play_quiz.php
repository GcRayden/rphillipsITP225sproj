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
        $answerCount++; // Increment the $answerCount variable
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
        foreach ($rand[$row] as $option) {
            $checked = '';
            $class = '';
            
            if (isset($_POST[$row]) && $_POST[$row] == $option) {
                $checked = 'checked';
                if ($option == $answerKey[$row]) {
                    $class = 'correct-answer';
                } else {
                    $class = 'wrong-answer';
                }
            }
            
            echo "<h3><input type='radio' id='" . $row . "' name='" . $row . "' value='" . $option . "' $checked><span class='$class'>" . $option . "</span></h3>";
        }
    }

    // Check for the right answer
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

        // Let the user know what score they got
        global $message;
        $message = "Your score is: " . $score . "/" . count($parsedQ);
    }
}

?>

<br/><br/>
<form method="POST" action="">
    <h2>Pick the correct answer:</h2>

    <!-- Call to get the quiz data -->
    <?php printQuizData($_GET['quiz']); ?><br/><br/>

    <!-- Submit button -->
    <button class="quizSubmit" type="submit" name="submitButton">Submit Quiz</button>
</form>

<h2>
    <!-- Message to the user -->
    <?php echo $message ?>
</h2>
<?php include './includes/footer.php'; ?>