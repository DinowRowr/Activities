<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "nba2023";
    // Connection 
    // return MYSQLI OBJECT

    $conn = mysqli_connect($host, $user, $pass, $db);
    
    if (!$conn){
        die("Connection failed" . mysql_error());
    }
    ?> 