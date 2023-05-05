<?php

  require('./model/connect_db.php');

  function login($username, $password)
  {
    $message = "Nothing";
    $mysqli = openConnection();
    // Generate Select statement
    $sql = "SELECT * FROM `rp_hw6_login` WHERE Username = '" . $username . "' AND Password = '" . $password . "'";
    $result = $mysqli->query($sql);

    // Check if a result is formed, if not, there's something wrong with the database
    if ($result)
    {
        if ($result->num_rows > 0)
        {
            // Let user know they've logged in
            $message = "You have been logged in!";
            //header("Location: account.php");
        }
        else
        {
            // Otherwise, send them to an error page
            $message = "You cannot be logged in!";
            //header("Location: error.php");
        }
    }
    else
    {
        // Lets Professor Lo know the database has an issue (this should not happen, but just in case..)
        //$message = "Error: No Results Returned!";
    }
    closeConnection($mysqli);
    return $message;
  }

  function returnMessage()
  {
    global $message;
    return $message;
  }

?>
