<?php
date_default_timezone_set("Asia/Colombo");
session_start();
require_once("db_connection.php");
require 'functions.php'; // Importing the function for generating and verifying doccode from this file

$physician_id = $_SESSION['id']; // setting up physician id
$patient_id = $_POST['patient_id']; // setting up patient id
$patient_id_confirm = ""; // setting up patient id
$doc_code = getRandomString(4); // Generating docCode
$date_time = date("Y-m-d H:i:s"); // Setting the current date and time


// Confirming the id belongs to a patient
$sql = "SELECT id, role FROM user WHERE id='$patient_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['role'] == 'patient') {
        $patient_id_confirm = true;    
    } else {
        $patient_id_confirm = false;        
    }
} else {
    $patient_id_confirm = false;  
}




// Generating a unique docCode
if ($patient_id_confirm) {
    while (checkDocCode($doc_code)) {
        $doc_code = getRandomString(4);        
    }
    // Creating a consultation
    $sql = "INSERT INTO consultation (physician, patient, docCode, date)
    VALUES ('$physician_id', '$patient_id', '$doc_code', '$date_time')";

    if ($conn->query($sql) === TRUE) {
    echo "<p>The following is the docCode for this consultation session:</p>";
    echo "<p id='doc_code'>$doc_code</p>";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "The patient id is not valid";
}





require_once("db_disconnection.php");


?>