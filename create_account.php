<?php

    $message = "";

    // Only start a session if one doesn't already exist
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $_SESSION['header'] = "Create Account";

    // Connect to the database
    require('./models/connect_db.php');

    if (isset($_POST['submitButton']))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];

      // Open connection to database
      $mysqli = openConnection();

      // Generate Select statement
      $sql = "SELECT * FROM `rp_sproj_login` WHERE Username = '" . $username . "'";
      $result = $mysqli->query($sql);

      $sqlData = array();

      // Check if a result is formed, if not, there's something wrong with the database
      if ($result)
      {
        // If the user is found in the database
        if ($result->num_rows > 0)
        {
          $message = "Username has been taken. Please try again.";

          // Set a temporary cookie
          $_COOKIE['message'] = $message;
          setcookie('message', $message, time() + (86400 * 30), "/"); // 1 day
          
          header('Location: create_account.php');
        }
        else
        {

          $sql2 = "INSERT INTO `rp_sproj_login` (Username, Password, FirstName, LastName) VALUES ('" . $username. "', '" . $password . "', '". $firstname . "', '" . $lastname . "')";
          if ($mysqli->query($sql2) === TRUE) {
              // Set the user's cookies, so they'll be remembered
              setcookie('username', $username, time() + (86400 * 30), "/"); // 1 day
              setcookie('password', $password, time() + (86400 * 30), "/"); // 1 day

              // Clear temp cookie
              unset($_COOKIE['message']);
              setcookie('message', '', time() - 3600, "/");

              if ($sqlData[2] != "")
                  setcookie('firstname', $sqlData[2], time() + (86400 * 30), "/"); // 1 day

              // Send them to the account page
              header("Location: account.php");
            } else {
              echo "Error: " . $sql2 . "<br>" . $mysqli->error;
            }
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

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2>Create an Account: </h2><br/>
        <form method="post">
            <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>" size="10" /><br>
            <label for="password">Password:</label>
                <input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES); ?>" size="10" /><br>
            <label for="firstname">First Name:</label>
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($_POST['firstname'] ?? '', ENT_QUOTES); ?>" size="10" /><br>
            <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" value="<?php echo htmlspecialchars($_POST['lastname'] ?? '', ENT_QUOTES); ?>" size="10" /><br>
            <input type="submit" name="submitButton"/>
        </form>
        <h2><?php if (isset($_COOKIE['message'])) { echo $_COOKIE['message']; } ?></h2>
    </body>
</html>