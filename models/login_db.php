<?php

// Only start a session if one doesn't already exist
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

  // Connect to the database
  require('./models/connect_db.php');

  /***********************
  * Login to the website *
  ************************/
  function login($username, $password)
  {
    // Variable to use for messages to the user
    $message = "";

    // Open connection to database
    $mysqli = openConnection();

    // Generate Select statement
    $sql = "SELECT * FROM `rp_sproj_login` WHERE Username = '" . $username . "' AND Password = '" . $password . "'";
    $result = $mysqli->query($sql);

    $sqlData = array();

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

          // Set the user's cookies, so they'll be remembered
          setcookie('username', $username, time() + (86400 * 30), "/"); // 1 day
          setcookie('password', $password, time() + (86400 * 30), "/"); // 1 day

          if ($sqlData[2] != "")
            setcookie('firstname', $sqlData[2], time() + (86400 * 30), "/"); // 1 day

          // Send them to the account page
          header("Location: account.php");
      }
      else
      {
        // Otherwise, tell them they have the wrong password
        $message = "Wrong username or password.";
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
  }

  /***********************
  *  Return any messages *
  ************************/
  function returnMessage()
  {
    global $message;
    return $message;
  }

?>
