<?php
date_default_timezone_set("Asia/Colombo");
session_start();
require_once("db_connection.php");
require 'functions.php'; // Importing the function for generating and verifying doccode from this file

$physician_id = $_SESSION['id']; // setting up physician id
$doc_code = getRandomString(4); // Generating docCode
$date_time = date("Y-m-d H:i:s"); // Setting the current date and time

// Setting up patient information
$medical_history = $_POST['medical_history'];
$family_medical_history = $_POST['family_medical_history'];
$symptoms = $_POST['symptoms'];
$allergies = $_POST['allergies'];


// Generating a unique docCode
while (checkDocCode($doc_code)) {
    $doc_code = getRandomString(4);        
}

// Creating a consultation
$sql = "INSERT INTO consultation (physician, docCode, date, medical_history, family_medical_history, symptoms, allergies)
VALUES ('$physician_id', '$doc_code', '$date_time','$medical_history', '$family_medical_history', '$symptoms', '$allergies')";

if ($conn->query($sql) === TRUE) {
    echo "<p>The following is the docCode for this consultation session:</p>";
    echo "<p id='doc_code'>$doc_code</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


require_once("db_disconnection.php");
?>