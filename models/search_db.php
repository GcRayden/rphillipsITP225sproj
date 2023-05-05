<?php

$message = "";

function getQuizzes($memberID)
{
  $sql = "SELECT * FROM `rp_sproj_quiz` INNER JOIN `rp_sproj_login` ON `rp_sproj_quiz.MemberID` = `rp_sproj_login.MemberID' WHERE MemberID = '" . $memberID . "'";
}

function getAllQuizzes()
{
  //$sql = "SELECT * FROM `rp_sproj_login` WHERE Username = '" . $username . "' AND Password = '" . $password . "'";
}

function searchDB($sql)
{
  // Variable to use for messages to the user
  $message = "";

  // Open connection to database
  $mysqli = openConnection();

  // Generate Select statement
  $result = $mysqli->query($sql);

  // First data array
  $sqlData = array(
    array('Name', 'Description', '# Items', 'Edit Quiz')
  );

  // Check if a result is formed, if not, there's something wrong with the database
  if ($result)
  {
    // If the user is found in the database
    if ($result->num_rows > 0)
    {
      // Go through data and put it into an array
      while($row = mysqli_fetch_array($result)) {
          $sqlData[] = $row;
      }
    }
    else
    {
      // Otherwise, tell them they have the wrong password
      $message = "No Quizzes Found.";
    }
  }
  else
  {
    // Lets Professor know the database has an issue (this should not happen, but just in case..)
    $message = "Error: No Results Returned!";
  }

  // Closes the connection to the database
  closeConnection($mysqli);

  // Return any messages that may have come up
  return $message;
  dataToTable($sqlData);
}

function dataToTable($data)
{

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
    }
    echo "</tr>";
  }

  // End the table
  echo "</table>";

  global $message;
  echo $message;
}
?>