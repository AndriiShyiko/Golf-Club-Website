<!--
Developed by: Andrii Shyiko
Date: 01/03/2026
Purpose: Database connection
-->

<?php
    $hostname = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "DB_NAME";

    $con = mysqli_connect($hostname, $username, $password, $dbname); //new connection to the database
    
    if (!$con) //if connection failed
    {
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }
?>