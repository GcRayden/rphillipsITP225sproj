<?php

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    header('Location: account.php');
}

$username = "";
$password = "";
$message = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['header'] = "Login Page";
} else {
    $_SESSION['header'] = "Login Page";
}

require('./models/login_db.php');

if (isset($_POST['submitButton']))
{
  // Get variables from HTML
  $username = $_POST['username'];
  $password = $_POST['password'];

  $message = login($username, $password);
}
?>

<?php include './includes/header.php';?>
    <h2>Robert's Quiz Website!</h2><br/>
    <h3>Login:</h3><br/>
    <form method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
            <button type="submit" name="submitButton">Login</button>
        </div>
    </form>

    <h3>Don't have an account? <a href="create_account.php">Create one here!</a>

    <h2><?php echo $message ?></h2>
<?php include './includes/footer.php';?>
