<?php
$servername = "localhost";
$username = "cardioVision";
$password = "cV2aI@rS&dO4";
$dbname = "CardioVision";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
