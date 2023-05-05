<?php

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    header('Location: account.php');
}

$username = "";
$password = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else {
    
}

require('./model/login_db.php');

if (isset($_POST['submitButton']))
{
  // Get variables from HTML
  $username = $_POST['username'];
  $password = $_POST['password'];

  $message = login($username, $password);
}
?>

<!doctype html>
<html>
    <head>
        <title>Login Page</title>
        <meta></meta>
        <style>

            body {
                margin: 0;
	            padding: 25px;
	            border: 0;
                text-align: center;
                background-color:darkslategrey;
            }

            label {
                font-size: larger;
                font-weight: 800;
                color:white;
            }

            select {
                font-size: larger;
                border-style: solid;
                border-width: 0px;
                overflow: hidden;
            }

            input {
                font-size: larger;
                border-style: solid;
                border-width: 2px;
                line-break: 10px;
            }

            h2, h3, p {
                color:goldenrod;
            }

        </style>
    </head>
    <body>
        <h2>Login: </h2><br/>
        <form method="post">
        <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>" size="10" /><br>
        <label for="password">Password:</label>
            <input type="text" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES); ?>" size="10" /><br>
            <input type="submit" name="submitButton"/>
        </form>

        <h3>Don't have an account? <a href="create_account.php">Create one here!</a>

        <h2><?php echo $message ?></h2>
    </body>
</html>
