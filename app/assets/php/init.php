<?php

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");  

    $db_name = "track_portal"; // Change the database name
    $username = "root";        // Change the username
    $pass = "";                // Change the password
    $servername = "localhost";

    $con = new mysqli($servername, $username, $pass, $db_name);
    // Check connection		
    if ($con->connect_error) {
       die("Connection failed: " . $con->connect_error);
    }
?>
