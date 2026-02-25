<?php
    //connecting to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "digital_consultant";        //Name of database
    $conn = mysqli_connect($servername, $username, $password, $database);
    //If connection fails
    if (!$conn) {
        die("Failed to connect: " . mysqli_connect_error());
    }
?>