<?php

$message = "";

// Only start a session if one doesn't already exist
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['header'] = "Create Account";

// Generate a random token
$submitToken = md5(uniqid(rand(), true));

// Set the cookie with the token
setcookie('submitToken', $submitToken, time() + 3600, '/');

// Connect to the database
require('./models/connect_db.php');

if (isset($_POST['submitButton'])) {

// Get the token from the cookie
$submitToken = isset($_COOKIE['submitToken']) ? $_COOKIE['submitToken'] : '';

// Get the token from the form submission
$submittedToken = $_POST['submitToken'];

// Check if the tokens match
if ($submitToken === $submittedToken) {
    $questions = $_POST['question'];
    $answers = array();
    foreach ($questions as $key => $question) {
        $answers[$key] = implode('@@@', array(
            $_POST['answer' . ($key + 1)][0],
            $_POST['answer' . ($key + 1)][1],
            $_POST['answer' . ($key + 1)][2],
            $_POST['answer' . ($key + 1)][3]
        ));
    }

    $questions_str = implode('@@@', $questions);
    $answers_str = implode('@@@', $answers);

    $memberID = $_COOKIE['memberid'];
    $name = $_POST['quizName'];
    $desc = $_POST['desc'];

    // Open connection to database
    $mysqli = openConnection();

    $sql = "INSERT INTO `rp_sproj_quiz` (MemberID, Name, Description, Questions, Answers) 
    VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $memberID, $name, $desc, $questions_str, $answers_str);
    
    if ($stmt->execute()) {
        // Send them to the account page
        $quiz_id = $mysqli->insert_id;
        header('Location: play_quiz.php?quiz=' . $quiz_id);
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();

    // Generate Select statement
    $result = $mysqli->query($sql);

    if ($result === TRUE) {
        // Send them to the account page
        $quiz_id = mysqli_insert_id($mysqli);
        header('Location: play_quiz.php?quiz=' . $quiz_id);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Closes the connection to the database
    closeConnection($mysqli);

    setcookie('submitToken', '', time() - 3600, '/');
} else {
    $message = "Error with the token!";
    // Return any messages that may have come up
    return $message;
}
}
?>

<?php include './includes/header.php'; ?>
<h2>Create a Quiz: </h2><br />

<form method="post">

    <br /><br /><label for="quizName">Quiz Name:</label>
    <input type="text" name="quizName" id="quizName" size="50" />
    <label for="quizName">Description:</label>
    <input type="text" name="desc" id="desc" size="50" />

    <?php
    $num_sets = 5; // Number of question/answer sets to create
    for ($i = 1; $i <= $num_sets; $i++) {
    ?>
        <div class="form-group">
            <br /><br /><label for="question<?php echo $i; ?>">Question:<?php echo $i; ?>:</label>
            <input type="text" name="question[]" id="question<?php echo $i; ?>" size="50" />
        </div>
        <div class="form-group">
            <label for="answer<?php echo $i; ?>_1">Correct Answer:</label>
            <input type="text" name="answer<?php echo $i; ?>[]" id="answer<?php echo $i; ?>_1" size="15" />
            <label for="answer<?php echo $i; ?>_2">Wrong Answer 1:</label>
            <input type="text" name="answer<?php echo $i; ?>[]" id="answer<?php echo $i; ?>_2" size="15" />
            <label for="answer<?php echo $i; ?>_3">Wrong Answer 2:</label>
            <input type="text" name="answer<?php echo $i; ?>[]" id="answer<?php echo $i; ?>_3" size="15" />
            <label for="answer<?php echo $i; ?>_4">Wrong Answer 3:</label>
            <input type="text" name="answer<?php echo $i; ?>[]" id="answer<?php echo $i; ?>_4" size="15" />
        </div>
    <?php
    }
    ?>
    <input type="hidden" name="submitToken" value="<?php echo $submitToken; ?>">
    <button type="submit" name="submitButton">Submit</button>
</form>

<h2>
    <?php if (isset($_COOKIE['message'])) {
        echo $_COOKIE['message'];
    } ?>
</h2>
<?php include './includes/footer.php'; ?>