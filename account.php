<?php

// Empty variable
$name = "";

// Send user to index.php if they're not logged in
// Otherwise, show their name or username
// Depends if they created an account with a name
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
} else {
    if (isset($_COOKIE['firstname']))
        $name = $_COOKIE['firstname'];
    else
        $name = $_COOKIE['username'];
}
?>

<?php include './includes/header.php';?>
<body>
    <?php include './includes/top_navbar.php';?>
    <h2>Welcome <?php echo $name ?>!</h2>
</body>
<?php include './includes/footer.php';?>