<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitaldb";

$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}