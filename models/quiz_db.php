<?php

// Only start a session if one doesn't already exist
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  // Connect to the database
  require('./models/connect_db.php');

function getQuizQuestions($quizID)
{
    $getQuiz = "SELECT Questions FROM `rp_sproj_quiz` WHERE rp_sproj_quiz.QuizID = " . $quizID;
    $quizData = searchDB($getQuiz);
    if (is_array($quizData)) {
        return $quizData;
    } else {
        echo "<h2>" . $quizData . "</h2>";
    }
}

function getQuizAnswers($quizID)
{
    $getQuiz = "SELECT Answers FROM `rp_sproj_quiz` WHERE rp_sproj_quiz.QuizID = " . $quizID;
    $quizData = searchDB($getQuiz);
    if (is_array($quizData)) {
        return $quizData;
    } else {
        echo "<h2>" . $quizData . "</h2>";
    }
}

function searchDB($quiz)
{
    global $message;

    // Open connection to database
    $mysqli = openConnection();

    $sqlData = "";
    $message = "";

    // Generate Select statement
    $result = $mysqli->query($quiz);

    // Check if a result is formed, if not, there's something wrong with the database
    if ($result) {
        // If the user is found in the database
        if ($result->num_rows > 0) {
            // Go through data and put it into an array
            while ($row = mysqli_fetch_row($result)) {
                $sqlData = "" . $row[0];
            }

            // Closes the connection to the database
            closeConnection($mysqli);
            return (string)$sqlData;

        } else {
            // Otherwise, tell them they have the wrong password
            $message = "No Quiz Data Found!";
        }
    } else {
        // Lets Professor know the database has an issue (this should not happen, but just in case..)
        $message = "Error: No Results Returned!";
    }

    // Closes the connection to the database
    closeConnection($mysqli);
    return $message;
}

?>