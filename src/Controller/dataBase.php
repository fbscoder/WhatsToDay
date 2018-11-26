<?php
$servername = "localhost";
$uname = "root";
$password = "";
$dbname = "whatstoday";

// Create connection
$conn = new mysqli($servername, $uname, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
