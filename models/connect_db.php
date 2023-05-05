<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

    // Check if submitted
    function openConnection()
    {
        // MySQL info
        $servername = "localhost";
        $username = "rp_sprojuser";
        $password = "rp_sprojpass";
        $dbname = "rp_sproj_db";

        $mysqli = new mysqli($servername, $username, $password, $dbname);

        if ($mysqli->connect_errno) {
         die('Could not connect to database!' . $mysqli->connect_error);
        }

        return $mysqli;
    }

    function closeConnection($mysqli)
    {
      // Close connection
      $mysqli->close();
    }
?>
