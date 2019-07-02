<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "db_arduino";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>