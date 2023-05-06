<?php

$message = "";

// Connect to the database
require('./models/connect_db.php');

function getQuizzes($memberID)
{
  $getQuiz = "SELECT QuizID, Name, Description FROM `rp_sproj_quiz` INNER JOIN `rp_sproj_login` ON rp_sproj_quiz.MemberID = rp_sproj_login.MemberID WHERE rp_sproj_quiz.MemberID = " . $memberID;
  searchDB($getQuiz);
}

function getAllQuizzes()
{
  //$sql = "SELECT * FROM `rp_sproj_login` WHERE Username = '" . $username . "' AND Password = '" . $password . "'";
}

function searchDB($quiz)
{
  global $message;

  // Open connection to database
  $mysqli = openConnection();

  // Generate Select statement
  $result = $mysqli->query($quiz);

  // First data array
  $sqlData = array(
    array('Quiz ID', 'Name', 'Description', 'Play')
  );

  // Check if a result is formed, if not, there's something wrong with the database
  if ($result)
  {
    // If the user is found in the database
    if ($result->num_rows > 0)
    {
      // Go through data and put it into an array
      while($row = mysqli_fetch_row($result)) {
          $sqlData[] = $row;
      }

      //array_unshift( $array, $header );
      //error_log('Quiz Found.', 0);
      $message = (count($sqlData) - 1) . " Quizzes Found!";
    }
    else
    {
      $memberid = $_COOKIE['memberid'];
      // Otherwise, tell them they have the wrong password
      $message = "No Quizzes Found!";
    }
  }
  else
  {
    // Lets Professor know the database has an issue (this should not happen, but just in case..)
    //array_unshift( $array, $header );
    $message = "Error: No Results Returned!";
  }

  // Closes the connection to the database
  closeConnection($mysqli);

  dataToTable($sqlData);
}

function dataToTable($data)
{
  $quizNum = 0;

  // Start the table
  echo "<table>";

  // Output the header row
  echo "<tr>";
  foreach ($data[0] as $header) {
    echo "<th>$header</th>";
  }
  echo "</tr>";

  // Output the data rows
  for ($i = 1; $i < count($data); $i++) {
    echo "<tr>";
    foreach ($data[$i] as $value) {
      echo "<td>$value</td>";
      if (is_numeric($value))
        $quizNum = $value;
    }
    echo "<td><button value='" . $quizNum . "'>Play</button></td>";
    echo "</tr>";
  }

  // End the table
  echo "</table>";

  global $message;
  echo "<h3>" . $message . "</h3>";
}
?>