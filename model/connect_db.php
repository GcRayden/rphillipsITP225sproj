<?php

    // Check if submitted
    function openConnection()
    {
        // MySQL info
        $servername = "localhost";
        $username = "rp_hw6user";
        $password = "rp_hw6pass";
        $dbname = "rp_hw6_db";

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
