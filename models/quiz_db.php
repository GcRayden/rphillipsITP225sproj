<?php

function getQuizData($quizID)
{
    $getQuiz = "SELECT QuizID, Name, Description FROM `rp_sproj_quiz` WHERE rp_sproj_quiz.QuizID = " . $quizID;
    $sqlData = array(array('Quiz ID', 'Name', 'Description', 'Play'));
    searchDB($getQuiz, $sqlData);
}

function searchDB($quiz, $sqlData)
{
    global $message;

    // Open connection to database
    $mysqli = openConnection();

    // Generate Select statement
    $result = $mysqli->query($quiz);

    // Check if a result is formed, if not, there's something wrong with the database
    if ($result) {
        // If the user is found in the database
        if ($result->num_rows > 0) {
            // Go through data and put it into an array
            while ($row = mysqli_fetch_row($result)) {
                $sqlData[] = $row;
            }

            // Closes the connection to the database
            closeConnection($mysqli);

            return $sqlData;
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
}
?>