<?php
    // Database credentials assigned to variables
    $host = "localhost"; // MySQL host
    $username = "root"; // MySQL username
    $password = ""; // MySQL password
    $database = "nba2023"; // MySQL database name

    // Connection 
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
    